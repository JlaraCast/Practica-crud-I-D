<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUsuario;
use App\Http\Requests\UpdateUsuario;
use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return User::all();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreUsuario $request)
    {
        $data = $request->validated();
        $post = User::create($data);
        return response()->json($post, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $post = User::find($id);

        if (!$post) {
            return response()->json(['message' => 'El usuario no se encontró :('], 404);
        }

        return response()->json($post);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateUsuario $request, User $user)
    {
        $data = $request->validated();
        $user->update($data);
        return response()->json($user);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        $user->delete();
        return response()->json(['message' => 'El usuario ha sido eliminado con éxito.']);
    }

}
