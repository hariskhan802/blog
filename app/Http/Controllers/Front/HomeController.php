<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $cats = \App\Category::with(['posts' => function($q){
                    $q->where('title', 'like', "%t%")->orderBy('id', 'DESC')->take(10);
                }])->get();
    

        return view('Front.index', ['cats' => $cats]);
    }
    public function post($id)
    {
        // $post = \App\Post::find($id)->commentUser;
        
        return view('Front.post', ['post' => \App\Post::find($id), 'comments' => \App\Comment::where('post_id', $id)->get()]);
    }
}
