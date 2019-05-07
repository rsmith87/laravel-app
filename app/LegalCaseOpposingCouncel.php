<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class LegalCaseOpposingCouncel extends Model
{
    protected $table = 'legal_case_opposing_councel';

    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = false;

    public $fillable = [
        'opposing_councel_name',
        'opposing_councel_phone',
        'opposing_councel_fax',
        'opposing_councel_address',
        'opposing_councel_city',
        'opposing_councel_state',
        'opposing_councel_zip',
        'case_id'
    ];

    /**
     * legal_case_billing belongsTo legal_case
     */

     public function legalCase()
     {
         return $this->belongsTo('legal_case');
     }
}
