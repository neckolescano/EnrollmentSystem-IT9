<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EnrollmentDetail extends Model
{
    protected $primaryKey = 'detail_id';
    protected $fillable = ['enrollment_id', 'section_id'];

    public function enrollment() {
        return $this->belongsTo(Enrollment::class, 'enrollment_id');
    }

    public function section() {
        return $this->belongsTo(Section::class, 'section_id');
    }
}

