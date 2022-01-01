<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;


    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'first_name',
        'last_name',
        'title',
        'summary',
        'tel',
        'photo',
        'cv',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
   
     //a user may have many posts
    public function posts()
      {
          return $this->hasMany(Post::class);
      }
    
    
      //a user may own many projects
    public function projects()
      {
          return $this->hasMany(Project::class);
      }
      
    public function interests()
    {
        return $this->belongsToMany(Interest::class);
    }

     //a user may have many investments
     
     public function investments()
     {
         return $this->hasMany(Investment::class);
     }
}