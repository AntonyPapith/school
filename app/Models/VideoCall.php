<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class VideoCall extends Model
{
    protected $fillable = ['teacher_id', 'student_id', 'status'];
}

