<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class Comments extends Model
{

	/**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'comments';
    protected $primaryKey = 'comments_id';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'client_id',
				'comment'
    ];


}
