<?php

namespace App\Http\Model;

use App\User;
use Illuminate\Database\Eloquent\Model;

class Group extends Model
{
    //
    public $timestamps = false;

    protected $table = 'user_group';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'manager_id',
    ];

    /**
     * members
     */
    public function users()
    {
        return $this->belongsToMany('App\User','group_member');
    }

}
