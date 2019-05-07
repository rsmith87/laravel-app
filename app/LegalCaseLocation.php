<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class LegalCaseLocation extends Model
{
    protected $table = 'legal_case_location';

    public $fillable = [
        'court_name',
        'city',
        'state',
        'case_id',
    ];

    /**
     * legal_case_billing belongsTo legal_case
     */

     public function legalCase()
     {
         return $this->belongsTo('legal_case');
     }
}
