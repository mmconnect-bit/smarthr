<?php

namespace App\Http\Controllers;

use App\Models\MainActivities;
use App\Models\Department;
use App\Models\Designation;
use App\Models\Employee;
use Illuminate\Http\Request;

class MainActivitiesController extends Controller
{
    public function index()
    {
        if (\Auth::user()->can('Manage Branch')) {
            $mainActivities = MainActivities::get();

            return view('mainActivities.index', compact('mainActivities'));
        } else {
            return redirect()->back()->with('error', __('Permission denied.'));
        }
    }

    public function create()
    {
        if (\Auth::user()->can('Create Branch')) {
            return view('mainActivities.create');
        } else {
            return response()->json(['error' => __('Permission denied.')], 401);
        }
    }

  public function store(Request $request)
{
    if (\Auth::user()->can('Create Branch')) {

        $validator = \Validator::make(
            $request->all(),
            [
                'name' => 'required',
                'payment_amount' => 'required|numeric',

            ]
        );

        if ($validator->fails()) {
            return redirect()->back()->with('error', $validator->errors()->first());
        }

        // Create a new MainActivities record
        $mainActivities = new MainActivities();
        $mainActivities->name = $request->name;
        $mainActivities->payment_amount = $request->payment_amount;
        $mainActivities->is_per_day = $request->is_per_day??false;
        $mainActivities->save();

        return redirect()
            ->route('mainActivities.index')
            ->with('success', __('Main activity successfully created.'));
    }

    return redirect()->back()->with('error', __('Permission denied.'));
}

    public function show()
    {
        return redirect()->route('mainActivities.index');
    }

public function edit(MainActivities $mainActivity)
{
    if (\Auth::user()->can('Edit Branch')) {

        return view('mainActivities.edit', compact('mainActivity'));
    }

    return response()->json(['error' => __('Permission denied.')], 401);
}

    public function update(Request $request, MainActivities $mainActivities)
    {
        if (\Auth::user()->can('Edit Branch')) {

                $validator = \Validator::make(
                    $request->all(),
                    [
                        'name' => 'required',
                    ]
                );
                if ($validator->fails()) {
                    $messages = $validator->getMessageBag();

                    return redirect()->back()->with('error', $messages->first());
                }

                $mainActivities->name = $request->name;
                $mainActivities->payment_amount = $request->payment_amount;
                $mainActivities->is_per_day = $request->is_per_day;
                $mainActivities->save();

                return redirect()->route('mainActivities.index')->with('success', __('Branch successfully updated.'));

        } else {
            return redirect()->back()->with('error', __('Permission denied.'));
        }
    }

    public function destroy(MainActivities $mainActivities)
    {
        if (\Auth::user()->can('Delete Branch')) {
                   $mainActivities->delete();
                return redirect()->route('mainActivities.index')->with('success', __('Branch successfully deleted.'));

        } else {
            return redirect()->back()->with('error', __('Permission denied.'));
        }
    }
}
