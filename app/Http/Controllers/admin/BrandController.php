<?php

namespace App\Http\Controllers\admin;

use Inertia\Inertia;
use App\Models\Brand;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class BrandController extends Controller
{
    public function index()
    {
        $brands = Brand::get();
        //dd($brands);

        return Inertia::render(
            'Admin/Brand/Index',
            [
                'brands' => $brands
            ]
        );
    }

    public function store(Request $request)
    {
        // dd($request->all());
        $brand = new Brand;
        $brand->name = $request->name;
        $brand->save();

        return redirect()->route('admin.brands.index')->with('success', 'Brand created successfully.');
    }

    public function update(Request $request, $id)
    {

        $brand = Brand::findOrFail($id);

        // dd($brand);
        $brand->name = $request->name;
        $brand->update();
        return redirect()->route('admin.brands.index')->with('success', 'Brand updated successfully.');
    }

    public function destory($id)
    {
        $brand = Brand::findOrFail($id)->delete();
        return redirect()->route('admin.brands.index')->with('success', 'Brand deleted successfully.');
    }



}
