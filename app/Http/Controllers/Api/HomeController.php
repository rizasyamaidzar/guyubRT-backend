<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\ResponResource;
use App\Models\Home;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $home = Home::with('user')->latest()->paginate(5);
        return new ResponResource(true, 'List Data Home', $home);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $validated = $request->validate([
            'number' => 'required',
            'type' => 'required',
            'status' => 'required',
        ]);
        $home = Home::create($validated);
        return new ResponResource(true, 'Succesfully Created', $home);
    }

    /**
     * Display the specified resource.
     */
    public function show(Home $home)
    {
        //
        $home = Home::with('user')->where('id', $home->id)->first();

        //return collection of home as a resource
        return new ResponResource(true, 'Detail Home', $home);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Home $home)
    {
        //
        $validated = $request->validate([
            'number' => 'required',
            'type' => 'required',
            'status' => 'required',
        ]);
        $home = Home::find($home->id);
        $home->update($validated);
        return new ResponResource(true, 'Updated Succesfully', $home);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Home $home)
    {
        //
        $home = Home::find($home->id);
        $home->delete();
        return new ResponResource(true, 'Delete Succesfully', $home);
    }
}
