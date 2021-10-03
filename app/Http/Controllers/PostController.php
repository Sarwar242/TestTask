<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Post;
use App\Models\Website;
use Illuminate\Support\Facades\Mail;
use App\Mail\NewPostMail;
use App\Events\PostCreated;

class PostController extends Controller
{
    public function create(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'title' => 'required|string',
            'description' => 'required|string',
            'website_id'=>'required'
        ]);
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }
        $post =  new Post;
        $post->title = $request->title;
        $post->description = $request->description;
        $post->website_id = $request->website_id;
        $post->save();
        PostCreated::dispatch($post);
        return response()->json([
            "success"  => true,
            "message" => "Post created successfully.",
            'post' => $post
        ], 200);
    }
}
