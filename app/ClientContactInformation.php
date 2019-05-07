<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ClientContactInformation extends Model
{
    protected $table = 'client_contact_info';

    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = false;

    protected $fillable = [
        'phone',
        'email',
        'address_1',
        'address_2',
        'city',
        'state',
        'zip',
        'client_id'
    ];

    public function client()
    {
        return $this->belongsTo('App\Client', 'client_id');
    }

}
