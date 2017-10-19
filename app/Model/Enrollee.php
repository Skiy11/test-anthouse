<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Enrollee extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $table = 'enrollees';
    protected $fillable = [
        'id',
        'name',
        'second_name',
        'sex',
        'group',
        'email',
        'points',
        'dob',
        'location'
    ];
}