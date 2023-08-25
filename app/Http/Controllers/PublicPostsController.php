<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

class PublicPostsController extends Controller
{
    public function index(): View 
    {
        $posts = Post::withCount('likes')->get();

        return view('welcome', compact('posts'));
    }    
}
