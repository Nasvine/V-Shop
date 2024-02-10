<?php

namespace App\Http\Controllers\admin;

use Inertia\Inertia;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::get();
        //dd($categories);

        return Inertia::render(
            'Admin/Category/Index',
            [
                'categories' => $categories
            ]
        );
    }

    public function store(Request $request)
    {
        // dd($request->all());
        $categorie = new Category;
        $categorie->name = $request->name;
        $categorie->save();

        return redirect()->route('admin.categories.index')->with('success', 'Category created successfully.');
    }

    public function update(Request $request, $id)
    {

        $categorie = Category::findOrFail($id);

        // dd($categorie);
        $categorie->name = $request->name;
        $categorie->update();
        return redirect()->route('admin.categories.index')->with('success', 'Category updated successfully.');
    }

    public function destory($id)
    {
        $categorie = Category::findOrFail($id)->delete();
        return redirect()->route('admin.categories.index')->with('success', 'Category deleted successfully.');
    }

}
