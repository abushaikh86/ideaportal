<?php

namespace App\Http\Controllers\backend;

use Illuminate\Http\Request;
use App\Models\frontend\Department;
use App\Models\frontend\User;
use App\Http\Controllers\Controller;
use App\Models\backend\Company;
use App\Models\backend\Designation;
use App\Models\backend\Location;

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Reader\Exception;
use PhpOffice\PhpSpreadsheet\Writer\Xls;
use PhpOffice\PhpSpreadsheet\IOFactory;

class ImportController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function index()
    {
        return view('backend.imports.import_external_user');
    }

    public function external_customer(Request $request)
    {
     //   dd($request->all());

        $excel_file = $request->file('uploadfile');


        //START

        try {
            $spreadsheet = IOFactory::load($excel_file->getRealPath());
            $sheet        = $spreadsheet->getActiveSheet();
            $row_limit    = $sheet->getHighestDataRow();
            $column_limit = $sheet->getHighestDataColumn();
            $row_range    = range(2, $row_limit);
            $column_range = range('V', $column_limit);
            $startcount = 2;
            $srno = 0;
            $data = array();
            $import_id = date('dmYhis');
            // $results = DB::select( DB::raw("SELECT CONCAT(school_name, ' (',board_name,') ', location) AS full_name FROM schools ") );
            $counter = 0;
            foreach ($row_range as $row) {
                $central_type = NULL;
                $central_val = trim(addslashes($sheet->getCell('G' . $row)->getValue()));
                if($central_val == 1){
                    $central_type = 1;
                }

                $location_name = trim(addslashes($sheet->getCell('H' . $row)->getValue()));
                $location_id = NULL;
                if(isset($location_name) && $location_name != ''){
                    $location = Location::where('location_name','like', $location_name )->first();
                   if($location){
                    $location_id = $location->location_id;
                   }
                }

                $department_name = trim(addslashes($sheet->getCell('I' . $row)->getValue()));
                $department_id = NULL;
                if(isset($department_name) && $department_name != ''){
                    $department = Department::where('name','like', $department_name )->first();
                   if($department){
                    $department_id = $department->department_id;
                   }
                }

                $company_name = trim(addslashes($sheet->getCell('J' . $row)->getValue()));

                $company_id = NULL;
                if(isset($company_name) && $company_name != ''){
                    $company = Company::where('company_name','like', $company_name )->first();

                   if($company){
                    $company_id = $company->company_id;
                   }
                }


                $designation_name = trim(addslashes($sheet->getCell('K' . $row)->getValue()));
                $designation_id = NULL;
                if(isset($designation_name) && $designation_name != ''){
                    $designation = Designation::where('designation_name','like', $designation_name )->first();
                   if($designation){
                    $designation_id = $designation->designation_id;
                   }
                }

                $mobile_number = NULL;
                $mob_no = trim(addslashes($sheet->getCell('E' . $row)->getFormattedValue()));
                if(is_numeric($mob_no)){
                    $mobile_number = $mob_no;
                }
              //  dd($location_id, $department_id, $company_id, $designation_id);

                    $name = trim(addslashes($sheet->getCell('B' . $row)->getValue()));
                    $last = trim(addslashes($sheet->getCell('C' . $row)->getValue()));

                $data[] = [
                    'import_id' => $import_id,
                    'emp_id' => trim(addslashes($sheet->getCell('A' . $row)->getFormattedValue())),  //date
                    'name' => trim(addslashes($sheet->getCell('B' . $row)->getValue())),
                    'last_name' => trim(addslashes($sheet->getCell('C' . $row)->getValue())),
                    'email' => trim(addslashes($sheet->getCell('D' . $row)->getValue())),
                    'mobile_no' =>  $mobile_number,
                    'password' =>   trim(addslashes($sheet->getCell('B' . $row)->getValue())),
                    'role' =>   trim(addslashes($sheet->getCell('F' . $row)->getValue())),
                    'centralized_decentralized_type' =>   $central_type,
                    'location' =>  $location_id , //
                    'location_name' =>  $location_name , //
                    'department' =>  $department_id ,
                    'department_name' =>  $department_name ,
                    'company_id' =>  $company_id ,
                    'company_name' =>  $company_name ,
                    'designation_id'=> $designation_id,
                    'designation_name'=> $designation_name,
                    'active_status'=>'1',
                    'status'=>'',
                    'sub_role'=>3
                ];

                $exist = User::where('email',$data[$counter]['email'])->first();

                if($exist){
                    $data[$counter]['status'] = 'Email already Exists';
                }else{
                    $user = new User();
                    if($name == '' || ! is_null($name) && $last == '' || ! is_null($last)){
                        $user->fill($data[$counter]);
                        $user->save();
                       // dd($user);
                    }
                }
                $counter++;
            }

            return view('backend.imports.import_user_details', compact('data'));

        } catch (Exception $e) {
            $error_code = $e->errorInfo[1];
            //  dd($error_code);
        }
    }

    public function display_result(Request $request){
        //dd($request->all());
    }
}
