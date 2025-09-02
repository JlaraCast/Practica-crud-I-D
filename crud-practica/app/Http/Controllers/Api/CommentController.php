<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreComment;
use App\Http\Requests\UpdateComment;
use App\Models\Comment;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Comment::all();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreComment $request)
    {
        $data = $request->validated();
        $comment = Comment::create($data);
        return response()->json($comment, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $comment = Comment::find($id);

        if (!$comment) {
            return response()->json(['message' => 'El comentario no se encontró :('], 404);
        }

        return response()->json($comment);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateComment $request, Comment $comment)
    {
        $data = $request->validated();

        $comment->update($data);
        return response()->json($comment);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Comment $comment)
    {
        $comment->delete();
        return response()->json(['message' => 'El comentario ha sido eliminado con éxito.']);
    }
}
