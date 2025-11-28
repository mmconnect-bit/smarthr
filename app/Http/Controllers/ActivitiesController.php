<?php

namespace App\Http\Controllers;

use App\Models\Activities;
use App\Models\Department;
use App\Models\Designation;
use App\Models\Employee;
use App\Models\MainActivities;
use Illuminate\Http\Request;

class ActivitiesController extends Controller
{
    public function index()
    {
        if (\Auth::user()->can('Manage Branch')) {
            $activities = Activities::get();

            return view('activities.index', compact('activities'));
        } else {
            return redirect()->back()->with('error', __('Permission denied.'));
        }
    }

    public function create()
    {
        if (\Auth::user()->can('Create Branch')) {
          $mainActivities= MainActivities::pluck('name', 'id');

            return view('activities.create',compact('mainActivities'));
        } else {
            return response()->json(['error' => __('Permission denied.')], 401);
        }
    }

   public function store(Request $request)
{
    if (!\Auth::user()->can('Create Branch')) {
        return redirect()->back()->with('error', __('Permission denied.'));
    }

    $validator = \Validator::make(
        $request->all(),
        [
            'name' => 'required|string|max:255',
            'main_activity_id' => 'required|exists:main_activities,id',
        ]
    );

    if ($validator->fails()) {
        return redirect()->back()->with('error', $validator->errors()->first());
    }

    $activities = new Activities();
    $activities->name = $request->name;
    $activities->main_activity_id = $request->main_activity_id;
    $activities->save();

    return redirect()->route('activities.index')->with('success', __('Activity successfully created.'));
}


    public function show(Branch $branch)
    {
        return redirect()->route('activities.index');
    }

    public function edit(Activities $activity)
    {
        if (\Auth::user()->can('Edit Branch')) {

            $mainActivities= MainActivities::pluck('name', 'id');


                return view('activities.edit', compact('activity',"mainActivities"));

        } else {
            return response()->json(['error' => __('Permission denied.')], 401);
        }
    }

public function update(Request $request, Activities $activities)
{
    if (!\Auth::user()->can('Edit Branch')) {
        return redirect()->back()->with('error', __('Permission denied.'));
    }

    // Validate inputs
    $validator = \Validator::make(
        $request->all(),
        [
            'name' => 'required|string|max:255',
            'main_activity_id' => 'required|exists:main_activities,id',
        ]
    );

    if ($validator->fails()) {
        return redirect()->back()->with('error', $validator->errors()->first());
    }

    // Update activity
    $activities->name = $request->name;
    $activities->main_activity_id = $request->main_activity_id;
    $activities->save(); // save() is correct here

    return redirect()
        ->route('activities.index')
        ->with('success', __('Activity successfully updated.'));
}

    public function destroy(Activities $activities)
    {
        if (\Auth::user()->can('Delete Branch')) {

                       $activities->delete();

                return redirect()->route('activities.index')->with('success', __('Branch successfully deleted.'));

        } else {
            return redirect()->back()->with('error', __('Permission denied.'));
        }
    }

    public function getdepartment(Request $request)
    {
        if ($request->branch_id == 0) {
            $departments = Department::get()->pluck('name', 'id')->toArray();
        } else {
            $departments = Department::where('branch_id', $request->branch_id)->get()->pluck('name', 'id')->toArray();
        }

        return response()->json($departments);
    }

    public function getemployee(Request $request)
    {
        if (in_array('0', $request->department_id)) {
            $employees = Employee::get()->pluck('name', 'id')->toArray();
        } else {
            $employees = Employee::whereIn('department_id', $request->department_id)->get()->pluck('name', 'id')->toArray();
        }

        return response()->json($employees);
    }
}
