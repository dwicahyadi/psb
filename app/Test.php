<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Test extends Model
{
    protected $fillable = ['user_id', 'token'];

    public function testDetails()
    {
        return $this->hasMany(TestDetail::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
