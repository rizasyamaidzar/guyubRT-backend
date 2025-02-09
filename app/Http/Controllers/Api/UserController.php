<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\ResponResource;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $user = User::with('home')->with('income')->latest()->paginate(5);
        return new ResponResource(true, "List Data User", $user);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $validated = $request->validate([
            'name' => 'required',
            'foto' => 'required',
            'number_phone' => 'required',
            'status' => 'required',
        ]);
        if ($request->file('foto')) {
            $image = $request->foto;
            $ext   = $image->getClientOriginalExtension();
            $randomString = Str::random(5);
            $imageName = $request->name . '-' . $randomString . '.' . $ext;
            $image->move(public_path('users'), $imageName);
            $validated['foto'] = 'http://127.0.0.1:8000/users/' . $imageName;
        }
        // dd($image);
        $validated['home_id'] = $request->home_id;
        $validated['pernikahan'] = $request->pernikahan;

        $user = User::create($validated);
        return new ResponResource(true, "Successfully Created", $user);
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        //
        $user = User::with('home')->with('income')->where('id', $user->id)->first();
        return new ResponResource(true, 'Detail User', $user);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user)
    {
        //cd..

        $validated = $request->validate([
            'name' => 'required',
            'foto' => 'required',
            'number_phone' => 'required',
            'status' => 'required',
        ]);
        $validated['home_id'] = 1;
        $validated['pernikahan'] = true;
        if ($request->file('foto')) {
            // menghapus data sebelumnya
            if ($request->oldFoto) {
                $filePath = $request->oldSampul;
                if (file_exists($filePath)) {
                    unlink($filePath); // Menghapus file
                }
            }
            $image = $request->foto;
            $ext   = $image->getClientOriginalExtension();
            $randomString = Str::random(5);
            $imageName = $request->name . '-' . $randomString . '.' . $ext;
            $image->move(public_path('users'), $imageName);
            $validated['foto'] = 'http://127.0.0.1:8000/users/' . $imageName;
        }
        dd($validated);
        $user = User::find($user->id);
        $user->update($validated);
        return new ResponResource(true, 'Updated Succesfully', $user);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        //
        $user = User::find($user->id);
        $user->delete();
        return new ResponResource(true, 'Delete Succesfully', $user);
    }
}
