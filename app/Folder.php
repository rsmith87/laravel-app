<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Folder extends Model
{
    protected $table = 'folders';

    public $fillable = [
        'uuid',
        'name',
        'user_id',
    ];

    public function documents()
    {
        return $this->hasMany('App\Document', 'folder_id');
    }
}
