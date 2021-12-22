<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Validator;
class CommentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        dd(\App\Comment::take(4)->get());
        return view('Admin.Comment.index', ['comments' => \App\Comment::addSelect(['user_name' => \App\User::select('name')->whereColumn('user_id', 'users.id'), 'post' => \App\Post::select('title')->whereColumn('post_id', 'posts.id')])->paginate(10)]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
    public function post_comment(Request $request)
    {
        $data = $request->all();
        $data['user_id'] = session('user_id');
        if (decrypt($data['_ioeqo'])) {
            $data['post_id'] = decrypt($data['_ioeqo']);
            $validated = Validator::make($request->all(), [
                'comment' => 'required|max:200',
            ]);
            if ($validated->fails()) {
                return redirect('post/'.$data['post_id'])->withErrors($validated)->withInput();
            }
            \App\Comment::create($data);
            return redirect('post/'.$data['post_id'])->with('message', 'You have successfully posted a Comment!');
        }else{
            return redirect('post/'.$data['post_id'])->with('message', 'Something Went Wrong!');
        }

    }
       
}
