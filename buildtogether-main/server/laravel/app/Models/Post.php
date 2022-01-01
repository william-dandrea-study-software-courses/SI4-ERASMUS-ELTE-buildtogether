<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;


    protected $fillable = [
        'title',
        'body',
        'user_id',
    
    ];

    //a post belongs to a user
    public function users()
    {
        return $this->belongsTo(User::class);
    }
    
}
