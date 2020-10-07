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

		$post = Post::create([
			'title' => $title,
			'body' => $body,
			'user_id' => $user->id,
		]);

		// store each image
		foreach ($images as $image) {
			$imagePath = Storage::disk('uploads')->put($user->email . '/posts', $image);
			PostImage::create([
				'post_image_caption' => $title,
				'post_iamge_path' => '/uploads/' . $imagePath,
				'post_id' => $post->id
			]);
		}
		return response()->json(['error' => false, 'data' => $post]);
	}
}
