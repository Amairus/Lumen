<?php

namespace App\Http\Controllers;
use App\Models\Post;
use Illuminate\Http\Request;
use App\Exceptions;

class PostController extends Controller
{
    public function index(){

        return Post::all();
    }

    public function store(Request $request)
    {
        try{
            $post = new Post();
            $post->title = $request->title;
            $post->body = $request->body;

            if($post->save())
                return response()->json(['status'=> 'success','messasge' => 'Post created succesfully']);
        }catch(\Exception $e){
            return response()->json(['status'=> 'error','messasge' => $e->getMessage()]);
        }
    }

    public function update(Request $request, $id)
    {
        try{
            $post = Post::findOrFail($id);
            $post->title = $request->title;
            $post->body = $request->body;

            if($post->save())
                return response()->json(['status'=> 'success','messasge' => 'Post created succesfully']);
        }catch(\Exception $e){
            return response()->json(['status'=> 'error','messasge' => $e->getMessage()]);
        }
    }

    public function destroy(Request $request, $id)
    {
        try {
            $post = Post::findOrFail($id);

            if($post->delete())
                return response()->json(['status'=> 'success','messasge' => 'Post deleted succesfully']);
        } catch(\Exception $e){
            return response()->json(['status'=> 'error','messasge' => $e->getMessage()]);
        }

    }

}
