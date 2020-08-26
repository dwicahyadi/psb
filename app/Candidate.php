<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Candidate extends Model
{
    protected $fillable = [
        'user_id',
        'major_id',
        'full_name',
        'nisn',
        'school_origin',
        'nem',
        'gender',
        'pob',
        'dob',
        'address',
        'photo',
        'ijazah_file',
        'nisn_file',
        'skl_file',
        'test_schedule',
        'test_access',
        'school_year',
        'be_accepted',
        'parent_name',
        'parent_job',
        'parent_phone',
        'number_of_siblings',
    ];

    public function major()
    {
        return $this->belongsTo(Major::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function test()
    {
        return $this->hasOne(Test::class,'user_id','user_id');
    }

}
