<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class LegalCaseBilling extends Model
{
    protected $table = 'legal_case_billing';

    public $fillable = [
        'is_billable',
        'billing_type',
        'billing_rate',
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
