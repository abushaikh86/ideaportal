<?php

namespace App\Http\Controllers\backend;

use Illuminate\Http\Request;
use App\Models\frontend\Ideas;
use App\Models\backend\Company;
use App\Models\backend\Location;
use App\Models\frontend\IdeaRevision;
use App\Models\frontend\Feedback;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\frontend\Department;

class LocationController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index()
    {
        $locations = Location::orderBy('location_id', 'DESC')->get();
        return view('backend.location.index', compact('locations'));
    }
    public function create()
    {
        return view('backend.location.create_location');
    }
    public function store(Request $request)
    {
        $request->validate([
            'location_name' => 'required'
        ]);
        $location = new Location();
        $location->fill($request->all());
        if ($location->save()) {

            // Activity Log
            $log = ['module' => 'Location Master', 'action' => 'Location Created', 'description' => 'New Location Created : ' . $request->location_name];
            captureActivity($log);

            return redirect()->route('admin.location')->with('success', 'Location Created Successfully!');
        } else {
            return redirect()->route('admin.location')->with('error', 'Failed to Create Location!');
        }
    }
    public function edit($id)
    {
        $location = Location::where('location_id', $id)->first();
        return view('backend.location.edit_location', compact('location'));
    }
    public function update(Request $request)
    {
        // dd($request->all());
        $request->validate([
            'location_name' => 'required'
        ]);
        $data = Location::where('location_id', $request->location_id)->get();
        if (count($data) > 0) {
            $location = Location::where('location_id', $request->location_id)->first();
            $old_location_name = $location->location_name;
            $location->fill($request->all());
            if ($location->save()) {

                // Activity Log
                $log = ['module' => 'Location Master', 'action' => 'Location Updated', 'description' => 'Location Updated : ' . $old_location_name  . ' to ' . $request->location_name];
                captureActivity($log);

                return redirect('/admin/location')->with('success', 'Location Has Been Updated');
            } else {
                return redirect('/admin/location/edit')->with('error', 'Failed to update location');
            }
        }
    }
    public function destroy($id)
    {
        $location = Location::where('location_id', $id)->get();
        if (count($location) > 0) {
            $location = Location::where('location_id', $id)->first();
            $old_location_name = $location->location_name;
            if ($location->delete()) {
                // Activity Log
                $log = ['module' => 'Location Master', 'action' => 'Location Deleted', 'description' => 'Location Deleted : ' . $old_location_name];
                captureActivity($log);
                return redirect('/admin/location')->with('success', 'Location Has Been Deleted');
            } else {
                return redirect('/admin/location')->with('error', 'failed to delete Location');
            }
        }
    }
}
