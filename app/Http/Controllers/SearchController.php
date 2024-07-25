<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Post;

class SearchController extends Controller
{
    public function search(Request $request)
    {
        $query = $request->input('query');
        $type = $request->input('type', 'users');

        if ($type === 'users') {
            $results = User::where('username', 'like', "%{$query}%")->get();
        } else {
            $results = Post::where('title', 'like', "%{$query}%")
                ->orWhere('body', 'like', "%{$query}%")
                ->with('user')
                ->get();
        }

        $recommendedUsers = User::where('id', '!=', auth()->id())->inRandomOrder()->take(5)->get();

        return view('search', compact('results', 'recommendedUsers', 'query', 'type'));
    }
}
