<?php

namespace App\Repositories\Interfaces;

use Illuminate\Http\Request;
use App\Category;

interface ICategoryRepository{
    public function all();
    public function exists($name);
    public function store(Request $request);
    public function getById($id);
    public function update(Request $request, Category $category);
    public function destroy(Category $category);
}