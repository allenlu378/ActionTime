<?php

namespace App\Http\Model;

use Illuminate\Database\Eloquent\Model;

class Assignment extends Model
{
    //

    public $timestamps = false;
    protected $table = 'assignment';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'current_value',
        'percent',
        'sort',
    ];

    public function task(){
        return $this->belongsTo('App\Http\Model\Task');
    }

    public function user(){
        return $this->hasOne('App\User');
    }

}
