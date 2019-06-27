<?php

namespace App\Http\Model;

use Illuminate\Database\Eloquent\Model;


class AuditRequest extends Model
{
    //
    public $timestamps = false;
    protected $table = 'audit_request';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'created_by',
        'description',
        'assignment_id',
        'add_value',
        'feedback',
        'result',
        'datetime',
        'auditor',
        'task_id',
    ];

    public function creator()
    {
        return $this->belongsTo('App\User','created_by');
    }

    public function task(){
        return $this->belongsTo('App\Http\Model\Task');
    }



}
