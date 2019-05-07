<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Firm extends Model
{
    protected $table = 'firm';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'uuid', 'name', 'logo', 'billing_details', 'phone', 'fax', 'email'
    ];

    public function firmLocation()
    {
        return $this->hasOne('App\FirmLocation', 'firm_id');
    }

    public function firmBilling()
    {
        return $this->hasOne('App\FirmBilling', 'firm_id');
    }
}
