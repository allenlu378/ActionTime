<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Challenge extends Model
{
    public $timestamps = false;

    protected $table = 'challenges';

    protected $fillable = [
        'challenge_type',
        'verified'
    ];

    public function task(){
        return $this->hasOne('App\Http\Model\Task');
    }
    public function startBy(){
        return $this->hasOne('App\Http\Providers\User');
    }
    public function user() {
        return $this->hasOne('App\Http\Providers\User');
    }
    public function group() {
        return $this->hasOne('App\Http\Model\Group');
    }


}
