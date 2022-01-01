<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Investment extends Model
{
    use HasFactory;
    protected $fillable =[
      'user_id',
      'project_id',
      'amount',
    ];

    //an investment belongs to one project
 public function projects()
 {
     return $this->belongsTo(Project::class);
 }
     //an investment belongs to one user
     public function users()
     {
         return $this->belongsTo(User::class);
     }
}
