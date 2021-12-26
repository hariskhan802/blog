<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
// use App\Models\Category;

class Post extends Model
{
    // protected $fillable = ['title', 'description', 'cat_id', 'user_id'];
    protected $guarded = ['id'];
    protected $appends = ['id_hash'];
    public function category(){
        return $this->belongsTo(Category::class, 'cat_id');
    }
    public function user(){
        return $this->belongsTo(User::class, 'user_id');
    }
    public function comments(){
        return $this->hasMany(Comment::class, 'post_id');
    }
    public function getIdHashAttribute(){
        return encrypt_decrypt('encrypt', $this->id);;
    }
    
    // public function commentUser(){
    //     return $this->hasManyThrough(User::class, Comment::class, 'post_id', 'post_id');
    // }
}
