<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller {
  /**
   * Display a listing of the resource.
   */
  public function index() {
    return view("blogs.index", [
      'posts' => Post::orderBy('PostID', 'DESC')->get(),
    ]);
  }

  /**
   * Show the form for creating a new resource.
   */
  public function create() {
  }

  /**
   * Store a newly created resource in storage.
   */
  public function store(Request $request) {
    $VALIDATED = $request->validate(
      [
        'Title' => 'required|string|max:255',
        'Body' => 'required|string',

      ],
      [
        'Title.required' => 'The title field is required.',
        'Title.max' => 'The title may not be greater than 255 characters.',
        'Body.required' => 'The body field is required.',
      ]
    );

    Post::create($VALIDATED);
    return redirect()->route('posts.index')->with('success', 'Post created successfully.');
  }

  /**
   * Display the specified resource.
   */
  public function show(Post $post) {
    //
  }

  /**
   * Show the form for editing the specified resource.
   */
  public function edit(Post $post) {
    return view("blogs.index", [
      'posts' => Post::orderBy('PostID', 'DESC')->get(),
      'editPost' => $post,
    ]);
    //
  }

  /**
   * Update the specified resource in storage.
   */
  public function update(Request $request, Post $post) {
    $VALIDATED = $request->validate(
      [
        'Title' => 'required|string|max:255',
        'Body' => 'required|string',
      ],
      [
        'Title.required' => 'The title field is required.',
        'Title.max' => 'The title may not be greater than 255 characters.',
        'Body.required' => 'The body field is required.',
      ]
    );

    $post->update($VALIDATED);
    return redirect()->route('posts.index')->with('success', 'Post updated successfully.');
  }

  /**
   * Remove the specified resource from storage.
   */
  public function destroy(Post $post) {
    $post->delete();
    return redirect()->route('posts.index')->with('success', 'Post deleted successfully.');
  }
}
