<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class Lab extends Model
{

	/**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'lab';
    protected $primaryKey = 'lab_id';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'lab_name'
    ];


}
