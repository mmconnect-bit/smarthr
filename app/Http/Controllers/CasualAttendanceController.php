<?php

namespace App\Http\Controllers;

use App\Exports\PayslipExport;
use App\Models\Allowance;
use App\Models\Commission;
use App\Models\Employee;
use App\Models\Loan;
use App\Mail\InvoiceSend;
use App\Mail\PayslipSend;
use App\Models\AccountList;
use App\Models\AttendanceEmployee;
use App\Models\Branch;
use App\Models\Department;
use App\Models\Expense;
use App\Models\OtherPayment;
use App\Models\Overtime;
use App\Models\PaySlip;
use App\Models\Resignation;
use App\Models\SaturationDeduction;
use App\Models\Termination;
use App\Models\User;
use App\Models\Utility;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Mail;
  use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Style\Border;
use PhpOffice\PhpSpreadsheet\Style\Fill;
use Carbon\CarbonPeriod;

class CasualAttendanceController extends Controller
{

    public function index(Request $request)
    {
        if (\Auth::user()->can('Manage Attendance')) {
            $branch = Branch::where('created_by', \Auth::user()->creatorId())->get()->pluck('name', 'id');
            $branch->prepend('All', '');

            $department = Department::where('created_by', \Auth::user()->creatorId())->get()->pluck('name', 'id');
            $department->prepend('All', '');

            if (\Auth::user()->type == 'employee') {
                $emp = !empty(\Auth::user()->employee) ? \Auth::user()->employee->id : 0;

                $attendanceEmployee = AttendanceEmployee::where('employee_id', $emp)->whereNotNull('activity_id');

                if ($request->type == 'monthly' && !empty($request->month)) {
                    $month = date('m', strtotime($request->month));
                    $year  = date('Y', strtotime($request->month));


                    $start_date = date($year . '-' . $month . '-01');
                    $end_date = date('Y-m-t', strtotime('01-' . $month . '-' . $year));

                    // old date
                    // $end_date   = date($year . '-' . $month . '-t');

                    $attendanceEmployee->whereBetween(
                        'date',
                        [
                            $start_date,
                            $end_date,
                        ]
                    );
                } elseif ($request->type == 'daily' && !empty($request->date)) {
                    $attendanceEmployee->where('date', $request->date);
                } else {
                    $month      = date('m');
                    $year       = date('Y');
                    $start_date = date($year . '-' . $month . '-01');
                    $end_date = date('Y-m-t', strtotime('01-' . $month . '-' . $year));

                    // old date
                    // $end_date   = date($year . '-' . $month . '-t');

                    $attendanceEmployee->whereBetween(
                        'date',
                        [
                            $start_date,
                            $end_date,
                        ]
                    );
                }

                $attendanceEmployee = $attendanceEmployee->get();
            } else {
                $employee = Employee::select('id')->where('created_by', \Auth::user()->creatorId());
                if (!empty($request->branch)) {
                    $employee->where('branch_id', $request->branch);
                }

                if (!empty($request->department)) {
                    $employee->where('department_id', $request->department);
                }

                $employee = $employee->get()->pluck('id');

                $attendanceEmployee = AttendanceEmployee::whereIn('employee_id', $employee);
                if ($request->type == 'monthly' && !empty($request->month)) {

                    $month = date('m', strtotime($request->month));
                    $year  = date('Y', strtotime($request->month));
                    $start_date = date($year . '-' . $month . '-01');
                    $end_date = date('Y-m-t', strtotime('01-' . $month . '-' . $year));

                    // old date
                    // $end_date   = date($year . '-' . $month . '-t');

                    $attendanceEmployee->whereBetween(
                        'date',
                        [
                            $start_date,
                            $end_date,
                        ]
                    );
                } elseif ($request->type == 'daily' && !empty($request->date)) {
                    $attendanceEmployee->where('date', $request->date);
                } else {

                    $month      = date('m');
                    $year       = date('Y');
                    $start_date = date($year . '-' . $month . '-01');
                    $end_date = date('Y-m-t', strtotime('01-' . $month . '-' . $year));
                    // old date
                    // $end_date   = date($year . '-' . $month . '-t');

                    $attendanceEmployee->whereBetween(
                        'date',
                        [
                            $start_date,
                            $end_date,
                        ]
                    );
                }

                $attendanceEmployee = $attendanceEmployee->with('activity')->get();
            }

            return view('casual-attendance.index', compact('attendanceEmployee', 'branch', 'department'));
        } else {
            return redirect()->back()->with('error', __('Permission denied.'));
        }
    }





public function export(Request $request)
{
    // Validate month
    $month = $request->query('month', date('Y-m'));
    $startDate = Carbon::parse($month)->startOfMonth();
    $endDate = Carbon::parse($month)->endOfMonth();
    $daysInMonth = $startDate->daysInMonth;
    $period = CarbonPeriod::create($startDate, $endDate);

    // Get attendance data with relationships
    $query = AttendanceEmployee::query()
        ->with(['employee', 'activity.activities']) // activity = sub, activities = main
        ->whereBetween('date', [$startDate, $endDate]);

    // Apply filters (branch, department, etc.) - reuse your existing logic
    if ($request->filled('branch')) {
        $query->whereHas('employee', fn($q) => $q->where('branch_id', $request->branch));
    }
    if ($request->filled('department_id')) {
        $query->whereHas('employee', fn($q) => $q->where('department_id', $request->department_id));
    }

    $attendances = $query->get();

    // Group by employee
    $employeesData = [];
    foreach ($attendances as $att) {
        $empId = $att->employee_id;
        if (!isset($employeesData[$empId])) {
            $employeesData[$empId] = [
                'employee' => $att->employee,
                'days' => [],
                'totalDays' => 0,
                'totalAmount' => 0,
            ];
        }

        $day = Carbon::parse($att->date)->day;
        $main = $att->activity?->activities; // Main Activity
        $sub = $att->activity;               // Sub Activity

        $activityText = $main
            ? "{$main->name} → {$sub?->name}"
            : ($sub?->name ?? 'No Activity');

        $employeesData[$empId]['days'][$day] = [
            'status' => $att->status,
            'activity' => $activityText,
            'main' => $main,
        ];

        if ($att->status === 'Present' && $main) {
            $employeesData[$empId]['totalDays']++;
            if ($main->is_per_day) {
                $employeesData[$empId]['totalAmount'] += $main->payment_amount;
            }
        }
    }

    // Add fixed payment (not per day)
    foreach ($employeesData as &$data) {
        $mainActs = collect($data['days'])->pluck('main')->filter();
        foreach ($mainActs as $main) {
            if (!$main->is_per_day) {
                $data['totalAmount'] += $main->payment_amount;
            }
        }
    }

    // Create Excel
    $spreadsheet = new Spreadsheet();
    $sheet = $spreadsheet->getActiveSheet();
    $sheet->setTitle("Payroll - " . $startDate->format('F Y'));

    // Company Header
    $sheet->mergeCells('A1:' . \PhpOffice\PhpSpreadsheet\Cell\Coordinate::stringFromColumnIndex(8 + $daysInMonth) . '1');
    $sheet->setCellValue('A1', "IRAD COMPANY LIMITED\nMonthly Attendance & Payroll Report\n" . $startDate->format('F Y'));
    $sheet->getStyle('A1')->getFont()->setBold(true)->setSize(16);
    $sheet->getStyle('A1')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);

    // Table Header Row (Row 3)
    $headerRow = 3;
    $col = 1;

    $headers = ['#', 'Employee Name', 'Department'];
    foreach ($period as $date) {
        $headers[] = $date->format('d');
    }
    $headers = array_merge($headers, ['Total Days', 'Rate Type', 'Amount (TZS)']);

    foreach ($headers as $header) {
        $cell = $sheet->getCellByColumnAndRow($col++, $headerRow)->getCoordinate();
        $sheet->setCellValue($cell, $header);
    }

    // Style Header
    $headerRange = 'A' . $headerRow . ':' . \PhpOffice\PhpSpreadsheet\Cell\Coordinate::stringFromColumnIndex(count($headers) - 1) . $headerRow;
    $sheet->getStyle($headerRange)->applyFromArray([
        'font' => ['bold' => true, 'color' => ['argb' => 'FFFFFFFF']],
        'fill' => ['fillType' => Fill::FILL_SOLID, 'startColor' => ['argb' => 'FF203764']],
        'alignment' => ['horizontal' => Alignment::HORIZONTAL_CENTER],
        'borders' => ['allBorders' => ['borderStyle' => Border::BORDER_THIN]],
    ]);

    // Fill Data
    $row = 4;
    $index = 1;
    foreach ($employeesData as $empId => $data) {
        $emp = $data['employee'];
        $col = 1;

        $sheet->setCellValueByColumnAndRow($col++, $row, $index++);
        $sheet->setCellValueByColumnAndRow($col++, $row, $emp?->name ?? 'Unknown');
        $sheet->setCellValueByColumnAndRow($col++, $row, $emp?->department?->name ?? '-');

        // Days 1 to 31
        for ($d = 1; $d <= $daysInMonth; $d++) {
            $activity = $data['days'][$d]['activity'] ?? '';
            $status = $data['days'][$d]['status'] ?? '';
            $text = $status === 'Present' ? $activity : $status;
            $sheet->setCellValueByColumnAndRow($col++, $row, $text);
        }

        // Summary
        $sheet->setCellValueByColumnAndRow($col++, $row, $data['totalDays']);
        $sheet->setCellValueByColumnAndRow($col++, $row, $data['totalDays'] > 0 && $data['employee']->activity?->activities?->is_per_day ? 'Per Day' : 'Fixed');
        $sheet->setCellValueByColumnAndRow($col++, $row, number_format($data['totalAmount'], 2));

        $row++;
    }

    // Auto-size all columns
   // Auto-size all columns — 100% safe, clean, and professional
foreach ($sheet->getColumnIterator('A', $sheet->getHighestColumn()) as $column) {
    $sheet->getColumnDimension($column->getColumnIndex())->setAutoSize(true);
}

    // Add borders to entire data
    $lastCol = \PhpOffice\PhpSpreadsheet\Cell\Coordinate::stringFromColumnIndex(count($headers) - 1);
    $sheet->getStyle("A3:{$lastCol}" . ($row - 1))->applyFromArray([
        'borders' => ['allBorders' => ['borderStyle' => Border::BORDER_THIN]],
    ]);

    // Protect with password
    $spreadsheet->getSecurity()->setLockWindows(true);
    $spreadsheet->getSecurity()->setLockStructure(true);
    $spreadsheet->getSecurity()->setWorkbookPassword('irad_123@');
    $sheet->getProtection()->setPassword('irad_123@');
    $sheet->getProtection()->setSheet(true);

    // Download
    $fileName = "IRAD_Payroll_{$startDate->format('F_Y')}.xlsx";

    return response()->streamDownload(function () use ($spreadsheet) {
        $writer = new Xlsx($spreadsheet);
        $writer->save('php://output');
    }, $fileName, [
        'Content-Type' => 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet',
    ]);
}

}
