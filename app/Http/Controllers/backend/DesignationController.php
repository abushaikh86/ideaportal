<?php

namespace App\Http\Controllers\backend;

use Illuminate\Http\Request;
use App\Models\backend\Location;
use App\Http\Controllers\Controller;
use App\Models\backend\Designation;

class DesignationController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index()
    {
        $designations = Designation::orderBy('designation_id', 'DESC')->get();
        return view('backend.designation.index', compact('designations'));
    }
    public function create()
    {
        return view('backend.designation.create_designation');
    }
    public function store(Request $request)
    {
        $request->validate([
            'designation_name' => 'required'
        ]);
        $designation = new Designation();
        $designation->fill($request->all());
        if ($designation->save()) {

            // Activity Log
            $log = ['module' => 'Designation Master', 'action' => 'Designation Created', 'description' => 'New Designation Created : ' . $request->designation_name];
            captureActivity($log);
            return redirect()->route('admin.designation')->with('success', 'Designation Created Successfully!');
        } else {
            return redirect()->route('admin.designation')->with('error', 'Failed to Create Designation!');
        }
    }
    public function edit($id)
    {
        $designation = Designation::where('designation_id', $id)->first();
        return view('backend.designation.edit_designation', compact('designation'));
    }
    public function update(Request $request)
    {
        // dd($request->all());
        $request->validate([
            'designation_name' => 'required'
        ]);
        $data = Designation::where('designation_id', $request->designation_id)->get();
        if (count($data) > 0) {
            $designation = Designation::where('designation_id', $request->designation_id)->first();
            $old_designation_name = $designation->designation_name;
            $designation->fill($request->all());
            if ($designation->save()) {

                // Activity Log
                $log = ['module' => 'Designation Master', 'action' => 'Designation Updated', 'description' => 'Designation Updated : ' . $old_designation_name  . ' to ' . $request->designation_name];
                captureActivity($log);

                return redirect('/admin/designation')->with('success', 'Designation Has Been Updated');
            } else {
                return redirect('/admin/designation/edit')->with('error', 'Failed to update Designation');
            }
        }
    }
    public function destroy($id)
    {
        $designation = Designation::where('designation_id', $id)->get();
        if (count($designation) > 0) {
            $department = Designation::where('designation_id', $id)->first();
            $old_designation_name = $department->designation_name;
            if ($department->delete()) {
                // Activity Log
                $log = ['module' => 'Designation Master', 'action' => 'Designation Deleted', 'description' => 'Designation Deleted : ' . $old_designation_name];
                captureActivity($log);
                return redirect('/admin/designation')->with('success', 'Designation Has Been Deleted');
            } else {
                return redirect('/admin/designation')->with('error', 'failed to delete Designation');
            }
        }
    }
}
