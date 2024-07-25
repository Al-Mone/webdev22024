<?php

// app/Http/Controllers/RedirectController.php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class RedirectController extends Controller
{
    public function handle(Request $request)
    {
        if ($request->input('action') == 'login') {
            return redirect()->route('login');
        } elseif ($request->input('action') == 'signup') {
            return redirect()->route('register');
        } else {
            return redirect()->route('landing');
        }
    }
}
