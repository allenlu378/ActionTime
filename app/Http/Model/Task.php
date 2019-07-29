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
        'total_value',
        'create_date',
        'average_workload',
        'suggested_times',
        'type',
        'img'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function challenges(){
        return $this->hasMany('App\Http\Model\Challenge');
    }

}
