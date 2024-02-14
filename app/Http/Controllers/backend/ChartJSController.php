<?php

namespace App\Http\Controllers\backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class ChartJSController extends Controller
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
    
}
