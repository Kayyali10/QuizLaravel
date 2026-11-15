<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Courses;
use App\Models\User;

class Lecturers extends Model
{
    use HasFactory;

      protected $fillable = [
        'name',
        'employee_number',
        'office_room',
        'photo',
    ];


    public function users(){
        
        return $this->belongsTo(User::class);
    }

    public function courses(){

     return $this->hasMany(Courses::class);
    }



}
