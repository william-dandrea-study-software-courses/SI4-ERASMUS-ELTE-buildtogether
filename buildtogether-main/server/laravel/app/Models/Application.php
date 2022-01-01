<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Application extends Model
{
    use HasFactory;
    protected $fillable = [
        'position_id',
        'applicant_id',
        'status',
        'applicationDate',
        'comment',
    
    ];

    //an application belongs to a position
    public function positions()
 {
     return $this->belongsTo(Position::class);
 }
}
