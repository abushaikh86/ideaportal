<?php

namespace App\Http\Controllers\backend;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Models\backend\Categories;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Session;
use \Cviebrock\EloquentSluggable\Services\SlugService;

class CategoriesController extends Controller
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
    public function index()
    {

        $categories = Categories::all();
        return view('backend.categories.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        return view('backend.categories.category_create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store(Request $request)
    {
      $this->validate($request, [
        'category_name' => 'required|unique:categories,category_name',
        'visibility' => 'required',
      ]);

      $categories = new Categories();
      $categories->fill($request->all());
      if($categories->save())
      {
        return redirect('admin/category')->with('success', 'category Details Has Been Added');
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
        $categories = Categories::findOrFail($id);

        return view('backend.categories.show', compact('categories'));
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
        $categories = Categories::where('category_id',$id)->first();
        return view('backend.categories.category_edit', compact('categories'));
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
        'category_name' => ['required'],
      ]);
      $id = $request->input('category_id');
      $categories = Categories::findOrFail($id);
      $categories->fill($request->all());
      if($categories->update())
      {
        return redirect('admin/category')->with('success', 'category Details Has Been updated');
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
        $categories = Categories::findOrFail($id);

        if($categories->delete()){
            return redirect('admin/category')->with('success', 'category Details Has Been Removed');
        }


    }

}
