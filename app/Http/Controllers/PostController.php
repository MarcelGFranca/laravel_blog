<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;
use App\PostImage;
use Auth;
use Storage;

class PostController extends Controller
{
	public function getAllPosts()
	{
		$posts = Post::with('post_images')->orderBy('created_by', 'desc')->get();
		return response()->json(['error' => false, 'data' => $posts]);
	}

	public function createPost(Request $request)
	{
		$user = Auth::user();
		$title = $request->title;
		$body = $request->body;
		$images = $request->images;

		$post = Post::
	}
}
