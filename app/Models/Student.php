<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    protected $primaryKey = 'student_id';
    protected $fillable = [
        'user_id', 
        'course_id', 
        'first_name', 
        'last_name', 
        'year_level', 
        'contact_number'
    ];
    public function user() {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function course() {
        return $this->belongsTo(Course::class, 'course_id');
    }

    public function enrollments() {
        return $this->hasMany(Enrollment::class, 'student_id');
    }
}
