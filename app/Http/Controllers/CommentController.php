<?php

namespace App\Http\Controllers;

use App\Comment;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    function create(Request $request)
    {
        $comment = Comment::create($request->toArray())->fresh();
        return $comment->toJson();
    }

    function read(Request $request, $id = null)
    {
        if (!$id)
            return Comment::getCommentsTree()->toJson();
        $comment = Comment::find($id);
        if ($comment)
            return $comment->toJson();
        return;
    }

    function update(Request $request, $id)
    {
        $comment = Comment::find($id);
        if ($comment) {
            $comment->body = $request->body;
            $comment->save();
            return $comment->fresh()->toJson();
        }
        return;
    }

    function delete(Request $request, $id)
    {
        $comment = Comment::find($id);
        if ($comment)
            $comment->delete();
        return;
    }

    function index(Request $request)
    {
        return view('comments/index');
    }
}
