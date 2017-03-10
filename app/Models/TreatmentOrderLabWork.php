<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class TreatmentOrderLabWork extends Model
{

	/**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'order_lab_work';
    protected $primaryKey = 'order_lab_work_id';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'client_id',
				'sample_collected_date',
				'reason_for_test',
				'collected_by',
				'test_requested_by',
				'counseling',
				'sample_type',
				'sample_shipped_date',
				'nexttestdate'
    ];


}
