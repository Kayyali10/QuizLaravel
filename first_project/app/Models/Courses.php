<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Lecturers;
use App\Models\Lectures;

class Courses extends Model
{

use HasFactory;
      protected $fillable = [
        'course_code',
        'title',
        'credit_hours',
        'semester',
    ];

    public function lecturers(){

    return $this->belongsTo(Lecturers::class);

    }

    public function lectures(){
        return $this->belongsTo(Lectures::class);
    }
}
