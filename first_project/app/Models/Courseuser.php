<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Courses;
use App\Models\User;
class Courseuser extends Model
{
     protected $fillable = [
        'enrollment_date',
        'grade',
    ];
 
     public function courses()
    {
        return $this->belongsTo(Courses::class);
    }
     public function users()
    {
        return $this->belongsTo(User::class); 
    }  
}
