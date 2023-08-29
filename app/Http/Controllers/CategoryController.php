<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CategoryController extends Controller
{
    //Direct category list page
    public function list(){
        $categories = Category::when(request('key'),function($query){
                                $query->where('name','like','%' . request('key'). '%');
                              })
                              ->orderBy('id','desc')->paginate(5);
        $categories->appends(request()->all());
        return view('admin.category.list',compact('categories'));
    }

    //Direct category create page
    public function createPage(){
        return view('admin.category.create');
    }

    //category create
    public function create(Request $request){
        $this->categoryValidationCheck($request);
        $data = $this->requestCategoryData($request);
        Category::create($data);
        return redirect()->route('category#list');
    }

    //delete category
    public function delete($id){
        Category::where('id',$id)->delete();
        return back()->with(['deleteSuccess'=>'Category Deleted...']);
    }

    //edit page
    public function edit($id){
        $category = Category::where('id',$id)->first();
        return view('admin.category.edit',compact('category'));
    }

    //update page
    public function update(Request $request) {
        $this->categoryValidationCheck($request);
        $data = $this->requestCategoryData($request);
        Category::where('id',$request->categoryId)->update($data);
        return redirect()->route('category#list');
    }

    //category validation check
    private function categoryValidationCheck($request){
       Validator::make($request->all(),[
            'categoryName' => 'required|min:4|unique:categories,name,'.$request->categoryId
       ])->validate();
    }

    //request category Data
    private function requestCategoryData($request){
        return [
            'name' => $request->categoryName
        ];
    }
}

