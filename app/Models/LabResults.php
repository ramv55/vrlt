<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class LabResults extends Model
{

	/**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'lab_results';
    protected $primaryKey = 'lab_results_id';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'client_id',
				'order_lab_work_id',
				'test_received_date',
				'equipment_type',
        'viral_load_detectable',
        'hiv_viral_load_results',
        'date_of_reporting',
				'created_lab_id',
				'lab_no'
    ];


}
