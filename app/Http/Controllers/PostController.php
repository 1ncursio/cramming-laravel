<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\PostImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;

class PostController extends Controller {
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        $posts = Post::with(['user', 'images'])->latest()->paginate(10);
        return Inertia::render('Posts/Index', ['posts' => $posts]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
        //
        return Inertia::render('Posts/Create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) {
        $request->validate([
            'title' => 'required|max:50',
            'content' => 'required',
        ]);

        DB::beginTransaction();
        try {
            $post = Post::create([
                'title' => $request->title,
                'content' => $request->content,
                'user_id' => Auth::id(),
            ]);
            error_log($post);
            error_log($request?->image);

            if ($request?->image) {
                $image = PostImage::create([
                    'url' => $request->image,
                    'post_id' => $post->id,
                ]);
                error_log($image);
            }
            DB::commit();
            return Redirect::route('posts.show', $post);
        } catch (\Exception $e) {
            DB::rollback();
            abort(500, $e->getMessage());
        }
    }

    public function storeImage(Request $request) {
        // $request->validate([
        //     'image' => 'required|image|mimes:jpg,png,jpeg,gif,svg',
        // ]);

        $name = $request->file('image')->getClientOriginalName();
        error_log($name);
        $extension = $request->file('image')->extension();
        error_log($extension);
        $nameWithoutExtension = Str::of($name)->basename('.' . $extension);

        $fileName = $nameWithoutExtension . '_' . time() . '.' . $extension;

        $request->file('image')->storeAs('public/images', $fileName);

        return $fileName;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post) {
        $post->load('user');
        $post->load('images');

        return Inertia::render('Posts/Show', ['post' => $post]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post) {
        $post->load('user');

        return Inertia::render('Posts/Edit', ['post' => $post]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Post $post) {
        $request->validate([
            'title' => 'required|max:50',
            'content' => 'required',
        ]);
        $post->title = $request->title;
        $post->content = $request->content;
        $post->save();

        return Redirect::route('posts.show', $post);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post) {
        $post->delete();
    }
}
