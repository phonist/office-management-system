<?php


namespace App\Services;

use App\Category;
use App\Repositories\Interfaces\ICategoryRepository;
use Illuminate\Http\Request;

class CategoryService{
    public $categories;

    public function __construct(
        ICategoryRepository $categories
    ){
        $this->categories = $categories;
    }

    public function all(){
        return $this->categories->all();
    }

    public function exists($name){
        return $this->categories->exists($name);
    }

    public function store($request){
        return $this->categories->store($request);
    }

    public function getById($id){
        return $this->categories->getById($id);
    }

    public function update(Request $request, Category $category){
        return $this->categories->update($request, $category);
    }

    public function destroy($category){
        return $this->categories->destroy($category);
    }
}