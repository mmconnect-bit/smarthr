<?php
use App\Imports\AttendanceImport;
use App\Models\AttendanceEmployee;
use App\Models\Employee;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Validator;

Route::post('/attendance/upload', function (Request $request) {

    // 1. Validate uploaded file
    $validator = Validator::make($request->all(), [
        'file' => 'required|file|mimes:csv,xlsx,xls,txt'
    ]);

    if ($validator->fails()) {
        return response()->json([
            'status'  => 'error',
            'message' => $validator->errors()->first()
        ], 422);
    }

    // 2. Import the file
    try {
        $rows = Excel::toArray(new AttendanceImport, $request->file('file'))[0];
    } catch (\Exception $e) {
        return response()->json([
            'status'  => 'error',
            'message' => 'Invalid or corrupted file.'
        ], 400);
    }

    if (empty($rows) || count($rows) < 2) {
        return response()->json([
            'status'  => 'error',
            'message' => 'File is empty or has no data rows.'
        ], 400);
    }

    // 3. Company working hours
    $startTime = \Utility::getValByName('company_start_time') ?: '09:00:00';
    $endTime   = \Utility::getValByName('company_end_time')   ?: '17:00:00';

    $processed   = 0;
    $failed      = 0;
    $errorEmails = [];

    foreach ($rows as $index => $row) {

        // Skip header row
        if ($index === 0) {
            $header = array_map('strtolower', array_map('trim', $row));

            continue;
        }

        // Clean row
        $row = array_pad(array_map('trim', $row), 4, null);
        [$email, $date, $clockIn, $clockOut] = $row;

        if (empty($email) || empty($date)) {
            $failed++;
            continue;
        }

        // Find employee (by work or personal email)
        $employee = Employee::where('email', $email)
            ->first();

        if (!$employee) {
            $errorEmails[] = $email;
            $failed++;
            continue;
        }

        // Normalize time format
        $clockIn  = $clockIn  ? date('H:i:s', strtotime($clockIn))  : null;
        $clockOut = $clockOut ? date('H:i:s', strtotime($clockOut)) : null;

        $status = $clockIn ? 'Present' : 'Absent';
        $late = $earlyLeaving = $overtime = '00:00:00';

        if ($clockIn && $clockIn > $startTime) {
            $late = gmdate('H:i:s', strtotime($clockIn) - strtotime($startTime));
        }
        if ($clockOut && $clockOut < $endTime) {
            $earlyLeaving = gmdate('H:i:s', strtotime($endTime) - strtotime($clockOut));
        }
        if ($clockOut && $clockOut > $endTime) {
            $overtime = gmdate('H:i:s', strtotime($clockOclockInut) - strtotime($endTime));
        }

        // Save or update attendance
        AttendanceEmployee::updateOrCreate(
            [
                'employee_id' => $employee->id,
                'date'        => $date,
            ],
            [
                'clock_in'      => $clockIn,
                'clock_out'     => $clockOut,
                'status'        => $status,
                'late'          => $late,
                'early_leaving' => $earlyLeaving,
                'overtime'      => $overtime,
                'created_by'    => 1, // or use a system user ID
            ]
        );

        $processed++;
    }

    return response()->json([
        'status'         => 'success',
        'message'        => 'Attendance uploaded successfully!',
        'processed'      => $processed,
        'failed'         => $failed,
        'missing_emails' => array_unique($errorEmails),
    ]);

})->name('attendance.upload'); // No middleware → public endpoint



Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
