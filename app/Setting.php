<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    protected $fillable = [
        'school_year',
        'test_duration',
        'minimum_nem',
        'minimum_score',
    ];
}
