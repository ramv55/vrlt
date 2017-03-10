<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class Discharge extends Model
{

	/**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'discharge';
    protected $primaryKey = 'discharge_id';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'client_id',
				'client_discharged',
				'date_of_discharge',
				'reason_for_discharge'
    ];


}
