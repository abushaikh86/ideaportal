<?php

namespace App\Http\Controllers\backend;

use Illuminate\Http\Request;
use App\Models\frontend\Department;
use App\Http\Controllers\Controller;


class DepartmentController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }
    public function departmentManagement()
    {
        return view('backend.department.index', ['departments' => Department::orderBy('department_id', 'DESC')->get()]);
    }
    public function addDepartment()
    {
        return view('backend.department.add_department');
    }
    public function storeDepartment(Request $request)
    {
        $this->validate($request, [
            'name' => ['required', 'unique:department,name']
        ]);
        $department = new Department();
        $department->name = $request->name;
        if ($department->save()) {

            // Activity Log
            $log = ['module' => 'Department Master', 'action' => 'Department Created', 'description' => 'New Department Created : ' . $request->name];
            captureActivity($log);

            return redirect()->route('admin.departmentManagement')->with('success', 'New Department Added!');
        } else {
            return redirect()->route('admin.departmentManagement')->with('error', 'Failed to add Department!');
        }
    }
    public function editDepartment($id)
    {
        $department = Department::where('department_id', $id)->first();
        return view('backend.department.editDepartment', compact('department'));
    }
    public function updateDepartment(Request $request)
    {
        $data = Department::where('department_id', $request->department_id)->get();
        if (count($data) > 0) {
            $department = Department::where('department_id', $request->department_id)->first();
            $old_department_name = $department->name;
            $department->fill($request->all());
            if ($department->save()) {

                // Activity Log
                $log = ['module' => 'Department Master', 'action' => 'Department Updated', 'description' => 'Department Updated : ' . $old_department_name  . ' to ' . $request->name];
                captureActivity($log);

                return redirect('/admin/departmentManagement')->with('success', 'Department Has Been Updated');
            } else {
                return redirect('/admin/departmentManagement')->with('error', 'Failed to update department');
            }
        }
    }
    public function deleteDepartment($id)
    {
        $department = Department::where('department_id', $id)->get();
        if (count($department) > 0) {
            $department = Department::where('department_id', $id)->first();
            $old_department_name = $department->name;
            if ($department->delete()) {
                // Activity Log
                $log = ['module' => 'Department Master', 'action' => 'Department Deleted', 'description' => 'Department Deleted : ' . $old_department_name];
                captureActivity($log);
                return redirect('/admin/departmentManagement')->with('success', 'Department Has Been Deleted');
            } else {
                return redirect('/admin/departmentManagement')->with('error', 'failed to delete Department');
            }
        }
    }
}
