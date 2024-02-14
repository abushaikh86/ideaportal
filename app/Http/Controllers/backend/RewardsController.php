<?php

namespace App\Http\Controllers\backend;

use Illuminate\Http\Request;
use App\Models\backend\Category;
use App\Http\Controllers\Controller;
use App\Models\frontend\Ideas;
use Illuminate\Support\Facades\Auth;

class RewardsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index()
    {
        $ideas = Ideas::where('certificate', 1)->where('implemented', 1)->where('active_status', 'implemented')->where('user_id', Auth::user()->user_id)->orderBy('idea_id', 'DESC')->get();
        return view('frontend.rewards.index', compact('ideas'));
    }
    public function view($id)
    {
        $idea = Ideas::where('idea_id', $id)->where('certificate', 1)->where('implemented', 1)->first();
        return view('backend.rewards.view', compact('idea'));
    }
    public function store(Request $request)
    {
        $request->validate([
            'category_name' => 'required'
        ]);
        $category = new Category();
        $category->fill($request->all());
        if ($category->save()) {
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

            $category->fill($request->all());
            if ($category->save()) {
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
            if (Category::where('category_id', $id)->delete()) {
                return redirect('/admin/category')->with('success', 'Category Has Been Deleted');
            }
        }
    }
}
