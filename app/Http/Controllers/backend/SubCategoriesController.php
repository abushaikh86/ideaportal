<?php

namespace App\Http\Controllers\backend;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\backend\Categories;
use App\Models\backend\SubCategories;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Session;
use \Cviebrock\EloquentSluggable\Services\SlugService;

class SubCategoriesController extends Controller
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
         $subcategories = SubCategories::where('category_id',$id)->get();
         return view('backend.subcategories.index', compact('subcategories', 'id'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create($id)
    {
        return view('backend.subcategories.subcategory_create', compact('id'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store(Request $request)
    {
      $this->validate($request, [
        'sub_category_name' => 'required',
        'visibility' => 'required',
      ]);

       $subcategories = new SubCategories();
       $subcategories->fill($request->all());
      if($subcategories->save())
      {
        return redirect('admin/subcategory/'.$request->category_id)->with('success', 'subcategory  Has Been Added');
      }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     *
     * @return Response
     */
    public function show($id)
    {
        // $categories = Categories::findOrFail($id);

        // return view('backend.categories.show', compact('categories'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     *
     * @return Response
     */
    public function edit($id)
    {
         $subcategories = SubCategories::where('sub_category_id',$id)->first();
         return view('backend.subcategories.subcategory_edit', compact('subcategories','id'));
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
        'sub_category_name' => ['required'],
      ]);
       $id = $request->input('sub_category_id');
       $subcategories = SubCategories::findOrFail($id);
       $subcategories->fill($request->all());
      if($subcategories->update())
      {
        return redirect('admin/subcategory/'.$subcategories->category_id)->with('success', 'Subcategory Details Has Been updated');
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
        $subcategories = SubCategories::findOrFail($id);
        $category_id = $subcategories->category_id;
        if($subcategories->delete()){
            return redirect('admin/subcategory/'.$category_id)->with('success', 'Subcategory Details Has Been Removed');
        }


    }

}
