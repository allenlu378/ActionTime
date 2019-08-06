<?php

namespace App\Http\Model;

use Illuminate\Database\Eloquent\Model;

class ApprovalRequest extends Model
{
    public $timestamps = false;

    protected $table = 'approval_request';

    protected $fillable = [
        'requested_by',
        'description',
        'challenge_progress_id',
        'add_value',
        'feedback',
        'result',
        'create_time',
        'approved_by'
    ];

    public function challengeProgress()
    {
        return $this->belongsTo('App\Http\Model\ChallengeProgress','challenge_progress_id')->with('Challenge');
    }
    public function requestedBy() {
        return $this->belongsTo('App\User','requested_by');
    }
}
