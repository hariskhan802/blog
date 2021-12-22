<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Redirect;
use File;
use Image;
// use App\Category;
// use Illuminate\Support\Facades\Hash;

class CategoryController extends Controller
{
    public function create(Request $request){
        
        if ($request->isMethod('post')) {
            $data = $request->all();
            $data['user_id'] = 1;
            $validated = Validator::make($data, [
                'name' => 'required|max:20',
                'description' => 'required|max:100',
                'image' => 'required|file|max:1024|mimes:jpeg,bmp,png,jpg',
            ]);
            if ($validated->fails()) {
                return redirect::back()->withErrors($validated)->withInput();
            }
            $image = $request->file('image');
            $input['imagename'] = 'cat-'.time().'.'.$image->extension();
            $path = public_path('/assets/images/category');
            if(!File::exists($path)){
                File::makeDirectory($path, $mode = 0777, true, true);
            }
            $img = Image::make($image->path());
            $img->resize(700, 400, function ($constraint) {
                $constraint->aspectRatio();
            })->save($path.'/'.$input['imagename']);
            $data['image'] = $input['imagename'];
            \App\Category::create($data);
            return Redirect::back()->with('message', 'Create Category successfully!');
            
        }
        else{
            return view('Admin.Category.create');
        }
    }
    public function index()
    {
        // $posts = \App\Category::chunk(100, function($posts){
        //     foreach ($posts as $key => $post) {
        //         // echo $posts;
        //     }
        // });die;
        // dd(\App\Category::join('users', 'users.id', '=', 'categories.user_id')->where('categories.user_id', 1)->get());
        // print_r($posts);die;
        // $cats = \App\Category::select(['categories.id', 'categories.name', 'categories.description', 'categories.image', 'users.name as user_name'])->join('users', 'users.id', '=', 'categories.user_id')->where('categories.user_id', 1)->paginate(2);
        // dd($cats);
        $cats = \App\Category::with(['posts' => function($q){
                    $q->where('title', 'like', "%post%")->orderBy('id', 'DESC')->take(10);
                }])->paginate(10)->sortByDesc('posts_count');
        // return $cats;
        // $cats = \App\Category::orderBy('id', 'DESC')->paginate(2);
        return view('Admin.Category.index', compact('cats'));
    }
    public function edit($id, Request $request)
    {
        if ($request->isMethod('post')) {
            $data = $request->all();
            $validated = Validator::make($data, [
                'name' => 'required|max:20',
                'description' => 'required|max:100',
                'image' => 'max:1024|mimes:jpeg,bmp,png,jpg'
            ]);
            if ($validated->fails()) {
                return back()->withErrors($validated);
            }
            $image = $request->file('image');
            $data['image'] = $data['prev_image'];
            if ($request->hasFile('image')) {
                $input['imagename'] = 'cat-'.time().'.'.$image->extension();
                $path = public_path('/assets/images/category');
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
            // dd($data);
            \App\Category::findOrFail(encrypt_decrypt('decrypt', $id))->update($data);
            return back()->with('message', 'Update Category successfully');
        }
        else{
            return view('Admin.Category.edit', ['cat' => \App\Category::findOrFail(encrypt_decrypt('decrypt', $id))]);
        }
    }
    public function delete($id = null, Request $request)
    {
        if ($request->isMethod('post')) {
            $ids = $request->input('ids');
            $ids = array_map(function($id) {
                return encrypt_decrypt('decrypt', $id);
            }, $ids);
            $cats = \App\Category::findOrFail($ids);
            foreach ($cats as $key => $cat) {
                File::delete(public_path('/assets/images/category/'.$cat->image));
            }
            \App\Category::destroy($ids);
            return back()->with('message', 'Delete Category successfully');
        }
        else{
            $id = encrypt_decrypt('decrypt', $id);
            $cat = \App\Category::findOrFail($id);
            File::delete(public_path('/assets/images/category/'.$cat->image));
            \App\Category::destroy($id);
            return back()->with('message', 'Delete Category successfully');
        }
    }
}
