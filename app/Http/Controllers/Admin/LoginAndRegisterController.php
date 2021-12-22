<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Validator;
use Hash;
// use Illuminate\Support\Facades\Validator;

class LoginAndRegisterController extends Controller
{
    public function login(Request $request){
        if ($request->isMethod('post')) {
            $data = $request->all();
            $validated = Validator::make($data, [
                'email' => 'required',
                'password' => 'required',
            ]);
            if ($validated->fails()) {
                return back()->withErrors($validated)->withInput();
            }
            $userInfo = \App\User::where(['email' => $data['email']])->first();

            // dd($userInfo);
            if ($userInfo) {
                if (Hash::check($data['password'], $userInfo->password)) {
                    session()->put(['user_id' => $userInfo->id, 'name' => $userInfo->name, 'email' => $userInfo->email]);
                    // print_r($request->query('redirect')); die;
                    if ($request->query('redirect')){

                        return redirect($request->query('redirect'));
                    }
                    return redirect('/admin/posts');
                }
                else{
                    return back()->with('message', 'Email or password is incorrect!');

                }
            }
            else{
                return back()->with('message', 'Email or password is incorrect!');
            }
        }
        else{
            return view('Admin.LoginAndRegister.login');
        }
    }
    public function register(Request $request){
        if ($request->isMethod('post')) {
            $data = $request->only('name', 'email', 'password');
            $validated = Validator::make($data, [
                'name' => 'required',
                'email' => 'required|email|unique:users',
                'password' => 'required|min:8',
            ]);
            if ($validated->fails()) {
                return back()->withErrors($validated)->withInput();
            }
            $data['password'] = bcrypt($data['password']);
            $data['image'] = '';
            $user = \App\User::create($data);
            $user = $user->toArray();
            $token = \Str::random(42);
            $user['token'] = $token;
            $user['url'] = url('/user/verify/'.$user['token']);
            \App\VerifyUser::create(['user_id' => $user['id'], 'token' => $token]);
            /*\Mail::send('Mail.user-verify-email', $user, function($msg) use ($user) {
                $msg->to($user['email'], $user['name'])->subject('Welcome to Blog');
            });*/
            // \Mail::to($user['email'])->send(new \App\Mail\VerifyEmail($user));
            dispatch(new \App\Jobs\SendEmailJob($user))->delay(now()->addSeconds(7));
            return back()->with('message', 'User Create Successfully');
            // return $request->input();
        }
        else{
            return view('Admin.LoginAndRegister.register');
        }
    }
    public function logout(){
        if (session()->has('user_id')) {
            session()->pull('user_id');
            session()->pull('name');
            session()->pull('email');
            return redirect('login');
        }
    }
    public function VerifyUser($token){
        $userId = \App\VerifyUser::where('token', $token)->first('user_id');
        // dd($userId->user_id);
        if ($userId->count() > 0) {

            $user = \App\User::find($userId->user_id);
            $user->email_verified_at = now();
            $user->save();
            session()->put(['user_id' => $user->id, 'name' => $user->name, 'email' => $user->email]);
            return redirect('admin/posts')->with('message', 'You have been verfied!');
        }
    }
}
