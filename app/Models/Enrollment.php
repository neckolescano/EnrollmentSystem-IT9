<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Enrollment extends Model
{
    protected $primaryKey = 'enrollment_id';
    protected $fillable = ['student_id', 'semester', 'school_year', 'enrollment_date', 'status'];

    public function student() {
        return $this->belongsTo(Student::class, 'student_id');
    }

    public function details() {
        return $this->hasMany(EnrollmentDetail::class, 'enrollment_id');
    }
}