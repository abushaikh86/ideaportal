<?php

namespace App\Http\Controllers\backend;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\backend\SubCategoryDetails;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Session;
use \Cviebrock\EloquentSluggable\Services\SlugService;

class SubCategorydetailsController extends Controller
{
  public function __construct()
  {
      $this->middleware('auth:admin');
  }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index($id)
    {

         $details = SubCategoryDetails::where('sub_category_id',$id)->get();
         return view('backend.subcategorydetails.index', compact('details', 'id'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create($id)
    {
        return view('backend.subcategorydetails.subcategorydetals_create', compact('id'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store(Request $request)
    {
      $this->validate($request, [
        'sub_category_details' => 'required',
        'visibility' => 'required',
      ]);

       $details = new SubCategoryDetails();
       $details->fill($request->all());
      if($details->save())
      {
        return redirect('admin/subcategorydetails/'.$request->sub_category_id)->with('success', 'Subcategory Details Has Been Added');
      }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     *
     * @return Response
     */
    // public function show($id)
    // {
    //     // $categories = Categories::findOrFail($id);

    //     // return view('backend.categories.show', compact('categories'));
    // }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     *
     * @return Response
     */
    public function edit($id)
    {
         $details = SubCategoryDetails::where('sub_category_details_id',$id)->first();
         return view('backend.subcategorydetails.subcategorydetals_edit', compact('details','id'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     *
     * @return Response
     */
    public function update(Request $request)
    {
      $this->validate($request, [
        'sub_category_details' => ['required'],
        'visibility' => ['required'],
      ]);
       $id = $request->input('sub_category_details_id');
       $details = SubCategoryDetails::findOrFail($id);
       $details->fill($request->all());
      if($details->update())
      {
        return redirect('admin/subcategorydetails/'.$details->sub_category_id)->with('success', 'Subcategory Details Has Been updated');
      }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     *
     * @return Response
     */
    public function delete($id)
    {
        $detaiils = SubCategoryDetails::findOrFail($id);
        $sub_category_id = $detaiils->sub_category_id;
        if($detaiils->delete()){
            return redirect('admin/subcategorydetails/'.$sub_category_id)->with('success', 'Subcategory Details Has Been Removed');
        }
    }

}
