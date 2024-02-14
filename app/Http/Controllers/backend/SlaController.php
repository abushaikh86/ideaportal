<?php

namespace App\Http\Controllers\backend;

use Illuminate\Http\Request;
use App\Models\frontend\Department;
use App\Http\Controllers\Controller;
use App\Models\backend\SLA;
use App\Models\Rolesexternal;

class SlaController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }
    public function index()
    {
        $data = SLA::with('get_role_name')->get();
        // dd($data);
        return view('backend.sla.index', compact('data'));
    }

    public function create()
    {
        $external_roles = Rolesexternal::where('role_type', '!=', 'User')->pluck('role_name', 'id');
        // dd($external_roles);
        return view('backend.sla.create', compact('external_roles'));
    }
    public function store(Request $request)
    {
        $request->validate([
            'role_id' => 'required',
            'deadline_days' => 'required',
        ]);
        $location = new SLA();
        $location->fill($request->all());

        $exist = SLA::where('role_id', $request->role_id)->first();
        if (empty($exist)) {
            $location->save();
            // Activity Log
            $log = ['module' => 'SLA', 'action' => 'SLA Created', 'description' => 'New SLA Created : ' . $request->location_name];
            captureActivity($log);

            return redirect()->route('admin.sla')->with('success', 'SLA Created Successfully!');
        } else if (!empty($exist)) {
            return redirect()->route('admin.sla.create')->with('error', 'SLA For This Role Already Exists!');
        } else {
            return redirect()->route('admin.sla')->with('error', 'Failed to Create SLA!');
        }
    }


    public function edit($id)
    {
        $external_roles = Rolesexternal::where('role_type', '!=', 'User')->pluck('role_name', 'id');
        $data = SLA::where('id', $id)->first();
        return view('backend.sla.edit', compact('data', 'external_roles'));
    }
    public function update(Request $request)
    {
        $request->validate([
            'role_id' => 'required',
            'deadline_days' => 'required',
        ]);

        $exist = SLA::where(['id' => $request->id, 'role_id' => $request->role_id])->first();
        // dd($exist);
        if (!empty($exist)) {
            $location = SLA::where('id', $request->id)->first();
            $old_location_name = $location->deadline_days;
            $location->fill($request->all());
            if ($location->save()) {

                // Activity Log
                $log = ['module' => 'SLA', 'action' => 'SLA Updated', 'description' => 'SLA Updated : ' . $old_location_name  . ' to ' . $request->deadline_days];
                captureActivity($log);

                return redirect('/admin/sla')->with('success', 'SLA Has Been Updated');
            } else {
                return redirect('/admin/sla/edit/' . $request->id . '')->with('error', 'Failed to update SLA');
            }
        } else {
            return redirect('/admin/sla/edit/' . $request->id . '')->with('error', 'SLA For This Role Already Exists!');
        }
    }
    public function destroy($id)
    {
        $location = SLA::where('id', $id)->get();
        if (count($location) > 0) {
            $location = SLA::where('id', $id)->first();
            $old_location_name = $location->location_name;
            if ($location->delete()) {
                // Activity Log
                $log = ['module' => 'SLA', 'action' => 'SLA Deleted', 'description' => 'SLA Deleted : ' . $old_location_name];
                captureActivity($log);
                return redirect('/admin/sla')->with('success', 'SLA Has Been Deleted');
            } else {
                return redirect('/admin/sla')->with('error', 'failed to delete SLA');
            }
        }
    }
}
