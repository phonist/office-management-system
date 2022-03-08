<?php

namespace App\Repositories\Eloquents;

use App\Repositories\Interfaces\ICategoryRepository;
use Illuminate\Http\Request;
use App\Category;
use Auth;

class CategoryRepository implements ICategoryRepository{
    protected $categories;

    public function __construct(
        Category $categories
    ){
        $this->categories = $categories;
    }

    public function all(){
        return $this->categories->where('user_id',Auth::user()->id)
                                ->orderBy('created_at', 'asc')
                                ->get();
    }

    public function exists($name){
        return $this->categories->where('name',$name)->exists();
    }

    public function store(Request $request){
        $category = $this->categories;
        $category->name = $request->category;
        $category->user_id = Auth::user()->id;
        return $category->save();
    }

    public function getById($id){
        return $this->categories->where('id',$id)->get();
    }

    public function update(Request $request, Category $category){
        $category = $this->categories->find($category->id);
        $category->name = $request->name;
        return ['result'=>$category->save()];
    }

    public function destroy(Category $category){
        $category = $this->categories->find($category->id);
        return ['result'=>$category->delete()];
    }
}