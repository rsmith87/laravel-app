<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class LegalCaseInvoice extends Model
{
    protected $table = 'legal_case_invoice';

    public $fillable = [
        'description',
        'case_id'
    ];

    public function invoiceLines()
    {
        return $this->hasMany('App\LegalCaseInvoiceLines', 'invoice_id');
    }

    /**
     * legal_case_billing belongsTo legal_case
     */

     public function legalCase()
     {
         return $this->belongsTo('legal_case');
     }
}
