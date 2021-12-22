<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    //
    /*protected $fillable = [
        'name', 'description','user_id'
    ];*/
    protected $guarded = ['id'];
    protected $appends = ['posts_count', 'id_hash'];
    public function posts()
    {
        return $this->hasMany(\App\Post::class, 'cat_id')/*->orderBy('id', 'DESC')*/;
    }
    public function latest_post()
    {
        return $this->hasOne(\App\Post::class, 'cat_id')->latestOfMany();
    }
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
    public function getPostsCountAttribute(){
        return $this->posts()->count();
    }
    public function getIdHashAttribute(){
        return encrypt_decrypt('encrypt', $this->id);
    }
    /*public function __posts($id){
        return \App\Post::where('id', $id)->chunk(200, function($posts) use {

        });
    }*/
}
