<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Client extends Model
{

    protected $table = 'client';

    public $fillable = [
        'uuid',         
        'prefix',
        'first_name',
        'last_name',
        'company',
        'company_title',
        'legal_case_id',
        'firm_id',  
        'owner_user_id',
        'client_user_id',
    ];

    public function legalCase()
    {
        return $this->hasOne('App\LegalCase', 'legal_case_id');
    }

    public function firm()
    {
        return $this->hasOne('App\Firm', 'firm_id');
    }

    public function ownerUser()
    {
        return $this->hasOne('App\User', 'owner_user_id');
    }

    public function clientUser()
    {
        return $this->hasOne('App\User', 'client_user_id', 'id');
    }

    public function clientContactInfo()
    {
        return $this->hasOne('App\ClientContactInformation');
    }
}
