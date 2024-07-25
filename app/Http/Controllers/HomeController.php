<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\User;

class HomeController extends Controller
{
    public function index()
    {
        $posts = Post::with('user')->orderBy('id', 'desc')->get();
        $recommendedUsers = User::where('id', '!=', auth()->id())->inRandomOrder()->take(5)->get();

        return view('home', compact('posts', 'recommendedUsers'));
    }
}
