<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Major extends Model
{
    protected $fillable = [
        'code',
        'major_name',
        'description',
        'logo',
        'class_open',
        'student_per_class',
    ];

    public function candidates()
    {
        return $this->hasMany(Candidate::class);
    }
}
