<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Position extends Model
{
    use HasFactory;
    protected $fillable = [
        'title',
        'project_id',
        'status'
    
    ];

 //a position belongs to one project
 public function projects()
 {
     return $this->belongsTo(Project::class);
 }

//a position may have many applications
 public function applications()
     {
         return $this->hasMany(Application::class);
     }


}
