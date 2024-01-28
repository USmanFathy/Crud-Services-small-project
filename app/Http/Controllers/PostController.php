<?php

namespace App\Http\Controllers;

use App\CrudServices\PostCreateService;
use App\CrudServices\PostDeleteService;
use App\CrudServices\PostUpdateService;
use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store()
    {
        return (new PostCreateService())->create();
    }

    /**
     * Display the specified resource.
     */
    public function show(Post $post)
    {
    }
    /**
     * Update the specified resource in storage.
     */
    public function update(Post $post)
    {
        return (new PostUpdateService($post))->update();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post)
    {
        return (new PostDeleteService($post))->delete();
    }
}
