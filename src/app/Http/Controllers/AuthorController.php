<?php

namespace App\Http\Controllers;

use App\Author;
use Illuminate\Http\Request;

class AuthorController extends Controller
{
    public function index(Request $request) {
        return response()->json(Author::all());
    }
}
