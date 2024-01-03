<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class AuthorController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        $author = User::where('name', $request['user'])->first();
        return inertia('Author', ['author' => $author]);
    }
}
