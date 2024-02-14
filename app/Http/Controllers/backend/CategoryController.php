<?php

namespace App\Http\Controllers\backend;

use Illuminate\Http\Request;
use App\Models\backend\Company;
use App\Http\Controllers\Controller;
use App\Models\backend\Category;
use Illuminate\Support\Facades\Auth;

class CategoryController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index()
    {
        $categories = Category::orderBy('category_id', 'DESC')->get();
        return view('backend.category.index', compact('categories'));
    }
    public function create()
    {
        return view('backend.category.create_category');
    }
    public function store(Request $request)
    {
        $request->validate([
            'category_name' => 'required'
        ]);
        $category = new Category();
        $category->fill($request->all());
        if ($category->save()) {

            // Activity Log
            $log = ['module' => 'Category Master', 'action' => 'Category Created', 'description' => 'New Category Created : ' . $request->category_name];
            captureActivity($log);

            return redirect()->route('admin.category')->with('success', 'Category Created Successfully!');
        } else {
            return redirect()->route('admin.category')->with('error', 'Failed to Create Category!');
        }
    }
    public function edit($id)
    {
        $category = Category::where('category_id', $id)->first();
        return view('backend.category.edit_category', compact('category'));
    }
    public function update(Request $request)
    {
        $request->validate([
            'category_name' => 'required'
        ]);
        $data = Category::where('category_id', $request->category_id)->get();
        if (count($data) > 0) {
            $category = Category::where('category_id', $request->category_id)->first();
            $old_category_name = $category->category_name;
            $category->fill($request->all());
            if ($category->save()) {

                // Activity Log
                $log = ['module' => 'Category Master', 'action' => 'Category Updated', 'description' => 'Category Updated : ' . $old_category_name  . ' to ' . $request->category_name];
                captureActivity($log);

                return redirect('/admin/category')->with('success', 'Category Has Been Updated');
            } else {
                return redirect('/admin/category/edit')->with('error', 'Failed to update Category');
            }
        }
    }
    public function destroy($id)
    {
        $category = Category::where('category_id', $id)->get();
        if (count($category) > 0) {
            $category = Category::where('category_id', $id)->first();
            $old_category_name = $category->category_name;
            if ($category->delete()) {
                // Activity Log
                $log = ['module' => 'Category Master', 'action' => 'Category Deleted', 'description' => 'Category Deleted : ' . $old_category_name];
                captureActivity($log);
                return redirect('/admin/category')->with('success', 'Category Has Been Deleted');
            } else {
                return redirect('/admin/category')->with('error', 'failed to delete Category');
            }
        }
    }
}
