<?php

namespace App\Http\Controllers\backend;

use Illuminate\Http\Request;
use App\Models\backend\Company;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use League\OAuth1\Client\Server\User;
use App\Models\frontend\Users;

class CompanyController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth', ['axcept'=>['getEmployees']]);
    }
    public function index()
    {
        $companies = Company::orderBy('company_id', 'DESC')->get();
        return view('backend.company.index', compact('companies'));
    }
    public function create()
    {
        return view('backend.company.create_company');
    }
    public function store(Request $request)
    {
        $request->validate([
            'company_name' => 'required'
        ]);
        $company = new Company();
        $company->fill($request->all());
        if ($company->save()) {
            // Activity Log
            $log = ['module' => 'Company Master', 'action' => 'Company Created', 'description' => 'New Company Created : ' . $request->company_name];
            captureActivity($log);
            return redirect()->route('admin.company')->with('success', 'Company Created Successfully!');
        } else {
            return redirect()->route('admin.company')->with('error', 'Failed to Create Company!');
        }
    }
    public function edit($id)
    {
        $company = Company::where('company_id', $id)->first();
        return view('backend.company.edit_company', compact('company'));
    }
    public function update(Request $request)
    {
        $request->validate([
            'company_name' => 'required'
        ]);
        $data = Company::where('company_id', $request->company_id)->get();
        if (count($data) > 0) {
            $company = Company::where('company_id', $request->company_id)->first();
            $old_company_name = $company->company_name;
            $company->fill($request->all());
            if ($company->save()) {

                // Activity Log
                $log = ['module' => 'Company Master', 'action' => 'Company Updated', 'description' => 'Company Updated : ' . $old_company_name  . ' to ' . $request->company_name];
                captureActivity($log);

                return redirect('/admin/company')->with('success', 'Company Has Been Updated');
            } else {
                return redirect('/admin/company/edit')->with('error', 'Failed to update Company');
            }
        }
    }
    public function destroy($id)
    {
        $company = Company::where('company_id', $id)->get();
        if (count($company) > 0) {
            $company = Company::where('company_id', $id)->first();
            $old_company_name = $company->company_name;

            if ($company->delete()) {
                // Activity Log
                $log = ['module' => 'Company Master', 'action' => 'Company Deleted', 'description' => 'Company Deleted : ' . $old_company_name];
                captureActivity($log);
                return redirect('/admin/company')->with('success', 'Company Has Been Deleted');
            } else {
                return redirect('/admin/company')->with('error', 'Failed to delete Company');
            }
        }
    }

    public function getEmployees(Request $request){
        $company_id = $request->company_id;


        // $employees = collect(Users::where('company_id', $company_id)->get())->mapWithKeys(function ($item, $key) {
        //     return [$item['user_id'] =>  (isset($item['name'])? $item->name : "").' '.(isset($item['last_name'])? $item->last_name : "")];
        //   });
        $employees = Users::where('company_id', $company_id)->get();
      //  echo "<option value=''>Select User</option>";
    if(isset($employees) && count($employees)>0){
        return json_encode($employees->toArray());
        // foreach($employees as $emp){
        // //    echo "<option value='".$emp->user_id."' id='spoc".$emp->user_id."'>".(isset($emp->name)?$emp->name:'').' '.(isset($emp->last_name)?$emp->last_name:'')."</option>";
        // }
    }
    }
}
