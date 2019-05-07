<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class LegalCase extends Model
{
    protected $table = 'legal_case';
    
    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = [
        'open_date',
        'close_date'
    ];

    /**
     * The storage format of the model's date columns.
     *
     * @var string
     */
    protected $dateFormat = 'Y-m-d';

    public $fillable = [
        'case_uuid',        
        'status', 
        'type',
        'number',
        'name',
        'description',       
        'claim_reference_number',
        'open_date',
        'close_date',
        'statute_of_limitations',
        'firm_id',
        'user_id',
        'client_id'
    ];

    public function legalCaseBilling()
    {
        return $this->hasOne('App\LegalCaseBilling', 'case_id');
    }

    public function legalCaseInvoice()
    {
        return $this->hasMany('App\LegalCaseInvoice', 'case_id');
    }

    public function legalCaseLocation()
    {
        return $this->hasOne('App\LegalCaseLocation', 'case_id');
    }

    public function legalCaseOpposingCouncel()
    {
        return $this->hasOne('App\LegalCaseOpposingCouncel', 'case_id');
    }

    public function client()
    {
        return $this->hasOne('App\Client');
    }


}
