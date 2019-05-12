<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Document extends Model
{
    public $fillable = [
        'uuid',
        'name',
        'type',
        'path',
        'data'
    ];
}
