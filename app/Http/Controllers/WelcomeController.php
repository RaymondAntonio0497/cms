<?php

namespace App\Http\Controllers;
use App\Category;
use App\Tag;
use App\Post;
use Illuminate\Http\Request;

class WelcomeController extends Controller
{
    public function index()
    {
        return view('welcome')
        ->with('categories', Category::all())
        ->with('posts', Post::searched()->simplePaginate(2))
        ->with('tags', Tag::all());
    }
}
