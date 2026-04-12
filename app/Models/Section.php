<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Section extends Model
{
    protected $primaryKey = 'section_id';
    protected $fillable = ['subject_id', 'instructor_id', 'semester', 'school_year', 'schedule', 'capacity'];

    public function subject() {
        return $this->belongsTo(Subject::class, 'subject_id');
    }

    public function instructor() {
        return $this->belongsTo(Instructor::class, 'instructor_id');
    }
}
