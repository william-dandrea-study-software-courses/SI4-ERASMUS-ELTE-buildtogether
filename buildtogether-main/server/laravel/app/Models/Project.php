<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'summary',
        'ptype',
        'category',
        'totalFund',
        'achievedFund',
        'startDate',
        'endDate',
        'photo',
        'owner',
    
    ];


    //a project belongs to a user (its owner)
    public function users()
    {
        return $this->belongsTo(User::class);
    }


     //a user may own many projects
     public function positions()
     {
         return $this->hasMany(Position::class);
     }
    //a project may have many investments
     
    public function investments()
     {
         return $this->hasMany(Investment::class);
     }

    
}
