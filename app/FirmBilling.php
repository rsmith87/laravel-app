<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FirmBilling extends Model
{
    protected $table = 'firm_billing';
    
    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = false;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'firm_id', 'firm_stripe_token', 'billing_details'
    ];

    public function firm()
    {
        return $this->belongsTo('App\Firm');
    }   
}
