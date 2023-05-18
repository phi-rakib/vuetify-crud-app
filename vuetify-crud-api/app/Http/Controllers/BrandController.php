<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class BrandController extends Controller
{
    /**
     * Display a listing of the brand.
     */
    public function index()
    {
        return Brand::all();
    }

    /**
     * Store a newly created brand in storage.
     */
    public function store(Request $request)
    {
        Brand::create($request->all());
    }

    /**
     * Display the specified brand.
     */
    public function show(Brand $brand)
    {
        return $brand;
    }

    /**
     * Update the specified brand in storage.
     */
    public function update(Request $request, Brand $brand)
    {
        $brand->update($request->all());
    }

    /**
     * Remove the specified brand from storage.
     */
    public function destroy(Brand $brand)
    {
        $brand->delete();
    }

    /**
     * Filters brands by name.
     */
    public function findByName(Request $request)
    {
        $name = $request->input('name');

        $brands = Brand::where('name', 'like', '%'.$name.'%')->get();

        return $brands;
    }
}
