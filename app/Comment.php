<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    protected $fillable = ['comment', 'post_id', 'user_id'];
    protected $appends = ['id_hash'];
    public function user() {
        return $this->belongsTo(User::class);
    }
    public function getIdHashAttribute(){
        return encrypt_decrypt('encrypt', $this->id);
    }
}
