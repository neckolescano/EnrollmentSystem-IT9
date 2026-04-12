<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Instructor extends Model
{
    protected $primaryKey = 'instructor_id';
    protected $fillable = ['instructor_name', 'department_id', 'email'];

    public function sections() {
        return $this->hasMany(Section::class, 'instructor_id');
    }
}
