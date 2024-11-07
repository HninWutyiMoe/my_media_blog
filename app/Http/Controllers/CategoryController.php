<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CategoryController extends Controller
{
    public function index(){
        $category = Category::get();
        return view('admin.category.index' , compact('category'));
    }

    // Search
    public function categorySearch(Request $request){
        $category = Category::where('title','Like','%'. $request->search .'%')->get();
        return view('admin.category.index',compact('category'));
    }

    // Add Category
    public function adding(Request $request){
        // dd($request->all());
        $data = $this->requestData($request);
        $this->formValidation($request);
        // dd($data);
        Category::create($data);
        return back()->with(['createdSuccess' => 'Category created success...']);
    }

    // Edit
    public function edit($id){
        $category = Category::get();
        $updateCategory = Category::where('id',$id)->first();
        return view('admin.category.edit',compact('category','updateCategory'));
    }
    public function update(Request $request){
    //    dd($request->all());
        $data = $this->requestData($request);
        $this->formValidation($request);
        Category::where('id',$request->categoryId)->update($data);
        return redirect()->route('admin#category')->with(['updateSuccess'=>'Category updated success...']);
    }
    // Delete
    public function delete($id){
        Category::where('id',$id)->delete();
        return redirect()->route('admin#category')->with(['deleteSuccess' => 'Category deleted success...']);
    }

    // Request
    private function requestData($request){
        return [
            'title' => $request->categoryName ,
            'description' => $request->description,
            'updated_at' => Carbon::now(),
        ];
    }

    // FormValidation

    private function formValidation($request){
        Validator::make($request->all() , [
            'categoryName' => 'required|unique:categories,title,'.$request->categoryId,
            'description' => 'required'
        ])->validate();
    }
}
