<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Enrollment extends Model
{
    use HasFactory;

    // Add this line below to allow data to be saved:
    protected $fillable = [
        'student_id',
        'student_name',
        'semester',
        'school_year',
        'status'
    ];
}