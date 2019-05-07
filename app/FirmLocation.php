<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FirmLocation extends Model
{
    protected $table = 'firm_location';

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
        'address_1', 'address_2', 'city', 'state', 'zip', 'firm_id'
    ];

    public function firm()
    {
        return $this->belongsTo('App\Firm');
    }
}
