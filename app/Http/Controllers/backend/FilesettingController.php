<?php

namespace App\Http\Controllers\backend;

use Illuminate\Http\Request;
use App\Models\frontend\Department;
use App\Http\Controllers\Controller;
use App\Models\backend\Filesetting;
use App\Models\backend\SLA;
use App\Models\Rolesexternal;

class FilesettingController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }
    public function index()
    {
        $data = Filesetting::get();

        $allowedExtensionsString = "jpg,jpeg,png,gif,bmp,tiff,webp,mp3,wav,ogg,flac,aac,mp4,avi,mkv,mov,flv,wmv,pdf,doc,docx,xls,xlsx,ppt,pptx,txt,zip,rar";

        $extensions = explode(',', $allowedExtensionsString);
        return view('backend.filesetting.index', compact('data', 'extensions'));
    }

    public function create()
    {
        // $external_roles = Rolesexternal::where('role_type', '!=', 'User')->pluck('role_name', 'id');
        // dd($external_roles);
        return view('backend.filesetting.create');
    }
    public function store(Request $request)
    {
        $request->validate([
            'allowed_extetnsion' => 'required',
            'file_size' => 'required',
        ]);
        $location = new Filesetting();
        // $extensions = implode(",", $request->allowed_extetnsion);
        // dd($extensions);
        $location->allowed_extetnsion = $request->allowed_extetnsion;
        $location->file_size = $request->file_size;


        $exist = Filesetting::where('allowed_extetnsion', $request->allowed_extetnsion)->first();
        if (empty($exist)) {
            $location->save();
            // Activity Log
            $log = ['module' => 'File Setting', 'action' => 'File Setting Created', 'description' => 'New File Setting Created'];
            captureActivity($log);

            return redirect()->route('admin.filesetting')->with('success', 'File Setting Created Successfully!');
        } else if (!empty($exist)) {
            return redirect()->route('admin.filesetting.create')->with('error', 'File Setting For This Extension Already Exists!');
        } else {
            return redirect()->route('admin.filesetting')->with('error', 'Failed to Create File Setting!');
        }
    }




    public function edit($id)
    {
        $data = Filesetting::where('id', $id)->first();
        $extensions_ex = explode(",", $data->allowed_extetnsion);
        // dd($extensions_ex);
        return view('backend.filesetting.edit', compact('data', 'extensions_ex'));
    }
    public function update(Request $request)
    {
        $request->validate([
            'allowed_extetnsion' => 'required',
            'file_size' => 'required',
        ]);


        $exist = Filesetting::where(['id' => $request->id, 'allowed_extetnsion' => $request->allowed_extetnsion])->first();
        // dd($exist);
        if (!empty($exist)) {
            $location = Filesetting::where('id', $request->id)->first();
            // $extensions = implode(",", $request->allowed_extetnsion);
            $location->allowed_extetnsion = $request->allowed_extetnsion;
            $location->file_size = $request->file_size;

            // $location->fill($request->all());
            if ($location->save()) {

                // Activity Log
                $log = ['module' => 'File Setting', 'action' => 'File Setting Updated', 'description' => 'File Setting Updated'];
                captureActivity($log);

                return redirect('/admin/filesetting')->with('success', 'File Setting Has Been Updated');
            } else {
                return redirect('/admin/filesetting/edit/' . $request->id . '')->with('error', 'Failed to update File Setting');
            }
        } else {
            return redirect('/admin/filesetting/edit/' . $request->id . '')->with('error', 'File Setting For This Extension Already Exists!');
        }
    }
    public function destroy($id)
    {

        $location = Filesetting::where('id', $id)->first();
        if ($location->delete()) {
            // Activity Log
            $log = ['module' => 'File Setting', 'action' => 'File Setting Deleted', 'description' => 'File Setting Deleted'];
            captureActivity($log);
            return redirect('/admin/filesetting')->with('success', 'File Setting Has Been Deleted');
        } else {
            return redirect('/admin/filesetting')->with('error', 'failed to delete File Setting');
        }
    }
}
