<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\ResponResource;
use App\Models\Category;
use App\Models\Home;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $category = Category::latest()->paginate(5);

        // return ResponResource::collection($home);
        // //return collection of home as a resource
        return new ResponResource(true, 'List Data Category', $category);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $validated = $request->validate([
            'name' => 'required',
            'amount' => 'required',
        ]);
        $category = Category::create($validated);
        return new ResponResource(true, 'Succesfully Created', $category);
    }

    /**
     * Display the specified resource.
     */
    public function show(Category $category)
    {
        //
        $category = Category::where('id', $category->id)->latest()->paginate(5)->first();

        // return ResponResource::collection($home);
        // //return collection of home as a resource
        return new ResponResource(true, 'List Data Category', $category);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Category $category)
    {
        //
        $validated = $request->validate([
            'name' => 'required',
            'amount' => 'required',
        ]);
        $category = Home::find($category->id);
        $category->update($validated);
        return new ResponResource(true, 'Updated Succesfully', $category);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category)
    {
        //
        $category = Category::find($category->id);
        $category->delete();
        return new ResponResource(true, 'Delete Succesfully', $category);
    }
}
