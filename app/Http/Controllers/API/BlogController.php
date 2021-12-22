<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
// use Illuminate\Support\Facades\Auth;


class BlogController extends Controller
{

    public function comment_create(Request $request){
        $validated = \Validator::make($request->all(), [
            'comment' => 'required|max:200',
            'post_id' => 'required',
            'user_id' => 'required',
        ]);
        if ($validated->fails()) {
            return $validated->errors();
        }
        else{
            \App\Comment::create($request->all());
            return ['result' => 'Comment successfully'];
        }
    }
    public function get_comment($id){
        return ['result' => \App\Comment::with(['user' => function($q){
            $q->select(['id', 'name']);
        }])->where('post_id', $id)->get()];
    }
    public function update_comment(Request $request){
        \App\Comment::findOrFail($id)->update($request->all());
        return ['result' => 'Comment successfully'];
        // return 
    }
    public function delete_comment($id){

        \App\Comment::destroy($id);
        return ['result' => 'Delete Comment successfully'];
        // return 
    }
    public function get_categories(){
        // return \App\Category::with('user')->select(['categories.name', 'categories.description'])->orderBy('categories.id', 'DESC')->get();

        return \App\Category::with(['user' => function($q){
                    $q->select(['id', 'name']);
                }])/*->select(['categories.name', 'categories.description'])*/->orderBy('categories.id', 'DESC')->get();
    }
    public function get_posts_by_category($id){
        $posts = \App\Post::where('cat_id', $id)->take(10)->get();
        return $posts;
    }
    public function get_posts_by_user($id){
        $posts = \App\Post::where('user_id', $id)->take(10)->get();
        return $posts;
    }
    public function get_post_result($search){
        // var_dump($search); die;
        $posts = \App\Post::join('users', 'users.id', '=', 'posts.user_id')->join('categories', 'categories.id', '=', 'posts.cat_id')->where('title', 'like', "%{$search}%")->take(10)->get(['title', 'users.name as user_name']);
        return $posts;
    }



    public function register(Request $request){
        // $data = $request->only('name', 'email', 'password');
        $data = $request->all();
        $validated = \Validator::make($data, [
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:8',
        ]);
        if ($validated->fails()) {
            return response()->json($validated->errors(), 200);
        }
        $data['password'] = bcrypt($data['password']);
        $data['image'] = '';

        $user = \App\User::create($data);
        $responseArray['token'] = $user->createToken('MyApp')->accessToken;
        $responseArray['name'] = $user->name;
        return response()->json($responseArray, 200);
    }
    public function login(Request $request){
        // $data = $request->only('name', 'email', 'password');
        $data = $request->all();
        $validated = \Validator::make($data, [
            'email' => 'required|email|',
            'password' => 'required',
        ]);
        if ($validated->fails()) {
            return response()->json($validated->errors(), 200);
        }
        // $data['password'] = bcrypt($data['password']);
        $userInfo = \App\User::where(['email' => $data['email']])->first();
        if (\Hash::check($data['password'], $userInfo->password)) {
            $responseArray['token'] = $userInfo->createToken('MyApp')->accessToken;
            $responseArray['name'] = $userInfo->name;
            return response()->json($responseArray, 200);

        }
        else{
            return response()->json($responseArray, 200);
        }
    }
}
