<?php

namespace App\Http\Model;

use Illuminate\Database\Eloquent\Model;

class Challenge extends Model
{
    public $timestamps = false;

    protected $table = 'challenges';

    protected $fillable = [
        'task_id',
        'award_id',
        'start_by',
        'due_time',
        'challenge_type',
        'group_id',
        'user_id',
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
    public function award()
    {
        return $this->belongsTo('App\Http\Model\Award', 'award_id');
    }
    public function startedBy() {
        return $this->belongsTo('App\User','start_by');
    }



}
