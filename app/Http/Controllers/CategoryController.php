<?php

namespace App\Http\Controllers;

use App\Services\CategoryService;
use Illuminate\Http\Request;
use App\Category;

class CategoryController extends Controller
{
    protected $categories;

    public function __construct(
        CategoryService $categories
    ){
        $this->categories = $categories;
    }

    public function index()
    {
        // $categories = Category::all();
        $categories = $this->categories->all();
        return view('admin.category.index',['categories'=>$categories]);  
    }

    public function store(Request $request)
    {
        if ($this->categories->exists($request->name)) {
            flash()->warning('This Category already exists!');
        }else{
            $category = $this->categories->store($request);
            if($category){
                flash()->success('New Category Added!');
            }else{
                flash()->error('Something went wrong!');
            }
        }
        return redirect()->route('category.index');     
    }

    public function edit(Category $category)
    {
        $categories = $this->categories->getById($category->id);
        return response()->json(['category'=>$categories]);
    }

    public function update(Request $request, Category $category)
    {
        $result = $this->categories->update($request, $category);
        if($result['result']){
            flash()->success('Category Data Updated!');
        }else{
            flash()->error('Something went wrong!');
        }
        return redirect()->route('category.index');  
    }
    
    public function destroy(Category $category)
    {
        $result = $this->categories->destroy($category);
        if($result['result']){
            flash()->success('Category Data deleted!');
        }else{
            flash()->error('Something went wrong!');
        }
        return redirect()->route('category.index');    
    }
}
