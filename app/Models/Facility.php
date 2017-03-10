<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class Facility extends Model
{

	/**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'facilities';
    protected $primaryKey = 'facility_id';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'lab_id',
				'facility_name',
				'facility_ctc_no',
				'facility_level',
				'facility_region',
				'facility_district'
    ];


}
