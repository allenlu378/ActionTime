<?php

namespace App\Http\Model;

use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    //
    public $timestamps = false;

    protected $table = 'task';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'description',
        'created_by',
        'audited_by',
        'total_value',
        'deadline',
        'type',
        'average_workload',
        'img'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function assigments(){
        return $this->hasMany('App\Http\Model\Assignment');
    }


}
