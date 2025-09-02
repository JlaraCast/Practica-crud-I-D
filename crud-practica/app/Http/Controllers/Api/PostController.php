<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StorePost;
use App\Http\Requests\UpdatePost;
use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Post::all();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorePost $request)
    {
        $data = $request->validated();
        $post = Post::create($data);
        return response()->json($post, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $post = Post::find($id);

        if (!$post) {
            return response()->json(['message' => 'El post no se encontró :('], 404);
        }

        return response()->json($post);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePost $request, Post $post)
    {
        $data = $request->validated();

        $post->update($data);
        return response()->json($post);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post)
    {
        $post->delete();
        return response()->json(['message' => 'El post ha sido eliminado con éxito.']);
    }
}
