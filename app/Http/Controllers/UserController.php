<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{
    public function show($id)
    {
        $user = User::with('posts', 'address', 'company')->findOrFail($id);
        $recommendedUsers = User::where('id', '!=', auth()->id())->inRandomOrder()->take(5)->get();

        return view('user', compact('user', 'recommendedUsers'));
    }
}
