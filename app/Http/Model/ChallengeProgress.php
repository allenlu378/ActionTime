<?php

namespace App\Http\Model;

use Illuminate\Database\Eloquent\Model;

class ChallengeProgress extends Model
{
    public $timestamps = false;

    protected $table = 'challenge__progress';

    protected $fillable = [
        'current_value',
        'percent',
        'ranking',
        'start_time',
        'finish_flag'
    ];

    public function challenge(){
        return $this->hasOne('App\Http\Model\Challenge');
    }
    public function user() {
        return $this->hasOne('App\Http\Providers\User');
    }
}
