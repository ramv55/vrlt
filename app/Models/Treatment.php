<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class Treatment extends Model
{

	/**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'treatment';
    protected $primaryKey = 'treatment_id';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'client_id',
				'art_status',
				'art_initiated_date',
				'art_medication',
				'previous_regimens'
    ];


}
