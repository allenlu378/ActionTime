<?php

namespace App\Http\Model;

use Illuminate\Database\Eloquent\Model;

class Challenge extends Model
{
    public $timestamps = false;

    protected $table = 'challenges';

    protected $fillable = [
        'challenge_type',
        'verified'
    ];

//    protected $appends =[
//        'task'
//    ];
//    public function getTaskAttribute(){
//        return $this->task();
//    }

    public function task(){
        return $this->belongsTo('App\Http\Model\Task','task_id');
    }

    public function startedBy() {
        return $this->belongsTo('App\User','start_by');
    }



}
