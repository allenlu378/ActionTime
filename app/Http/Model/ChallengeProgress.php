<?php

namespace App\Http\Model;

use Illuminate\Database\Eloquent\Model;

class ChallengeProgress extends Model
{
    public $timestamps = false;

    protected $table = 'challenge_progress';

    protected $fillable = [
        'current_value',
        'percent',
        'ranking',
        'start_time',
        'finish_flag'
    ];

    public function challenge(){
        return $this->belongsTo('App\Http\Model\Challenge','challenge_id')->with('Task', 'startedBy');
    }
    public function user() {
        return $this->hasOne('App\User');
    }

}
