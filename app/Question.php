<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    protected $fillable = [
        'subjects',
        'question',
        'question_image',
        'option_a',
        'option_b',
        'option_c',
        'option_d',
        'answer',
        'score',
    ];

}
