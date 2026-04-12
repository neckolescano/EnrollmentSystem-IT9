<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Subject extends Model
{
    public $incrementing = true;
    protected $primaryKey = 'subject_id';
    protected $fillable = ['course_id', 'subject_code', 'subject_name', 'units'];

    public function sections() {
        return $this->hasMany(Section::class, 'subject_id');
    }
}
