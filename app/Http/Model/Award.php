<?php

namespace App\Http\Model;

use Illuminate\Database\Eloquent\Model;

class Award extends Model
{


    public $timestamps = false;
    protected $table = 'award';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'description',
        'offered_by',
        'total_num',
        'remaining_num',
        'img',
        'award_name',
    ];

}
