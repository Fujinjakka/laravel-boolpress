<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;
use App\InfoPost;
use App\Tag;
use App\Image;
use Illuminate\Support\Str;

class PostController extends Controller
{
    private $postValidation = [
        "title" => "required|string|max:150",
        "subtitle" => "required|string|max:100",
        "text" => "required|string",
        "author" => "required|string|max:60",
        "img_path" => "required|string|max:255",
        "publication_date" => "required|date",
    ];
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Post::all();
        return view("posts.index", compact("posts"));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $tags = Tag::all();
        $images = Image::all();
        return view("posts.create", compact('tags', 'images'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->all();

        $data['slug'] = Str::slug($data['title']);
        $request->validate($this->postValidation);
        $post = new Post();
        $post->fill($data);
        $post->save();

        $data['post_id'] = $post->id;
        $infoPost = new infoPost();
        $infoPost->fill($data);
        $infoPost->save();

        if (!empty($data['tags'])) {
           $post->tags()->attach($data['tags']);
        }

        

        return redirect()->route("posts.index")->with("message", "Post" . $post->name . "creato correttamente!");
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        return view("posts.show", compact("post"));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        $tags = Tag::all();
        $images = Image::all();


        return view("posts.edit", compact("post", "tags", "images"));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Post $post)
    {
        $data = $request->all();
        $data['slug'] = Str::slug($data['title']);
        $request->validate($this->postValidation);
        $post->update($data);

        $infoPost = InfoPost::where('post_id', $post->id)->first();
        $data['post_id'] = $post->id;
        $infoPost->update($data);

        if (!empty($data['tags'])) {
           $post->tags()->sync($data['tags']);
        }else{
            $post->tags()->detach();
        }

        if (!empty($data['images'])) {
           $post->images()->sync($data['images']);
        }else{
            $post->images()->detach();
        }


        return redirect()->route("posts.index")->with("message", "Post" . $post->name . "aggiornato correttamente!");

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        $post->delete();
        return redirect()->route("posts.index")->with("message", "Il Post " . $post->title .  " cancellato correttamente!");
    }
}
