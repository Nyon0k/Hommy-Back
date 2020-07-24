<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Comment;

class CommentController extends Controller
{
    public function createComment(Request $request){
    	$comment = new Comment;
    	$comment->dateHour = $request->dateHour;
    	$comment->commentary = $request->commentary;
    	$comment->save();
    	return response()->json($comment);
    }

    public function showComment($id){
    	$comment = Comment::findOrFail($id);
    	return response()->json($comment);
    }

    public function listComment(){
    	$comment = Comment::all();
    	return response()->json([$comment]);
    }

    public function updateComment(Request $request, $id){
    	$comment = Comment::findOrFail($id);
    	if($request->dateHour){
    		$comment->dateHour = $request->dateHour;
    	}
    	if($request->commentary){
    		$comment->commentary = $request->commentary;
    	}
    	$comment->save();
    	return reponse()->json([$comment]);
    }

    public function deleteComment($id){
    	Comment::destroy($id);
    	return response()->json(['Produto deletado']);
    }

    public function addComment($id, $comment_id){
    	$user = User::findOrFail($id);
    	$comment = Comment::findOrFail($comment_id);
    	$comment->user_id = $id;
    	$comment->save();
    	return response()->json($comment);
    }

    public function removeComment($id, $comment_id){
    	$user = User::findOrFail($id);
    	$comment = Comment::findOrFail($comment_id);
    	$comment->user_id = Null;
    	$comment->save();
    	return response()->json($comment);
    }
}
