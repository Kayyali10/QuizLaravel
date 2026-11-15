<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Courses;

class Lectures extends Model
{
      protected $fillable = [
        'title',
        'topic_summary',
        'hall_name',
    ];

    public function courses(){

    return $this->hasMany(Courses::class);

    }
}
