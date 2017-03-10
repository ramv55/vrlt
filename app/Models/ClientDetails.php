<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class ClientDetails extends Model
{

	/**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'client_details';
    protected $primaryKey = 'cleint_id';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'client_uid',
				'dob',
				'age',
				'gender',
				'name',
				'client_counselled',
				'increase_note',
        'pregnant_feeding',
        'currently_enrolled_in',
        'pmct_enrolment_date',
        'phone',
				'tb_suspect',
				'tb_medication',
        'created_by'
    ];


}
