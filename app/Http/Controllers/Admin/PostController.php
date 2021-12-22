<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use File;
use Image;

class PostController extends Controller
{
    public function create(Request $request)
    {
        if($request->isMethod('post')) {
            $data = $request->all();
            $data['user_id'] = 1;
            $validated = Validator::make($request->all(), [
                'title' => 'required|max:20',
                'description' => 'required|max:100',
                'cat_id' => 'required',
                // 'image' => 'required|max:1024|mimes:jpeg,bmp,png,jpg',
                'image' => 'required|file|max:1024|mimes:jpeg,bmp,png,jpg',
            ]);
            if($validated->fails()){
                return back()->WithErrors($validated)->withInput();
            }
            $image = $request->file('image');
            $input['imagename'] = 'post-'.time().'.'.$image->extension();
            $path = public_path('/assets/images/post');
            if(!File::exists($path)){
                File::makeDirectory($path, $mode = 0777, true, true);
            }
            $img = Image::make($image->path());
            $img->resize(700, 400, function ($constraint) {
                $constraint->aspectRatio();
            })->save($path.'/'.$input['imagename']);
            $data['image'] = $input['imagename'];
            \App\Post::create($data);
            return back()->with('message', 'Create Post Successfully');
        }
        else {
            $cats = \App\Category::all();
            return view('Admin.Post.create', ['cats' => $cats]);
        }
    }
    public function index(Request $request)
    {
        // dd(\App\Post::firstWhere(['title' => 'post 1']));
        // $posts = \App\Post::where('cat_id', 1)->get();

/*        \App\Post::where('cat_id', 1)->chunk(1000, function($posts){
            foreach($posts as $post){
                // echo ($post);
                $post->update(['cat_id' => 2]);
            }
        });*/
        // print_r($posts->toArray());
        $posts = \App\Post::query();
        if ($request->input('search')) {
            $posts->where('posts.title', 'like', "%{$request->input('search')}%")->Orwhere('posts.description', 'like', "%{$request->input('search')}%");
        }
        if ($request->input('cat_id')) {
            $posts->where('cat_id', $request->input('cat_id'));
        }
        return view('Admin.Post.index', ['posts' => $posts->select(['posts.id', 'posts.title', 'posts.description', 'posts.image', 'users.name as user_name', 'categories.name as cat_name'])->leftjoin('users', 'users.id', '=', 'posts.user_id')->leftjoin('categories', 'categories.id', '=', 'posts.cat_id')->where('categories.user_id', 1)->orderBy('posts.id', 'DESC')->paginate(500)->withQueryString(), 'cats' => \App\Category::all()]);
    }
    public function edit($id, Request $request)
    {
        if ($request->isMethod('post')) {
            $data = $request->all();
            $data['user_id'] = 1;
            $validated = Validator::make($request->all(), [
                'title' => 'required|max:10',
                'description' => 'required|max:100',
                'cat_id' => 'required',
                'image' => 'max:1024|mimes:jpeg,bmp,png,jpg'
            ]);
            if($validated->fails()){
                return back()->withErrors($validated);
            }

            $image = $request->file('image');
            $data['image'] = $data['prev_image'];
            if ($request->hasFile('image')) {
                $input['imagename'] = 'post-'.time().'.'.$image->extension();
                $path = public_path('/assets/images/post');
                if(!File::exists($path)){
                    File::makeDirectory($path, $mode = 0777, true, true);
                }
                $img = Image::make($image->path());
                $img->resize(700, 400, function ($constraint) {
                    $constraint->aspectRatio();
                })->save($path.'/'.$input['imagename']);
                $data['image'] = $input['imagename'];
                File::delete($path.'/'.$data['prev_image']);
            }

            $data['id'] = $id;
            \App\Post::findOrFail(encrypt_decrypt('decrypt', $id))->update($data);
            return back()->with('message', 'Update Post Successfully');
        }
        else {

            return view('Admin.Post.edit', ['post' => \App\Post::findOrFail(encrypt_decrypt('decrypt', $id)), 'cats' => \App\Category::all()]);
        }
    }
    public function delete($id = null, Request $request)
    {
        
        if ($request->isMethod('post')) {
            $ids = $request->input('ids');
            $ids = array_map(function($id) {
                return encrypt_decrypt('decrypt', $id);
            }, $ids);
            $posts = \App\Post::findOrFail($ids);
            foreach ($posts as $key => $post) {
                File::delete(public_path('/assets/images/post/'.$post->image));
            }
            \App\Post::destroy($ids);
            return back()->with('message', 'Delete Post successfully');
        }
        else{
            $post = \App\Post::find($id);
            if (!$post) 
                return redirect('admin/posts');
            File::delete(public_path('/assets/images/post/'.$post->image));
            \App\Post::destroy($id);
            return back()->with('message', 'Delete Post successfully');
        }
    }
}
