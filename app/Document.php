<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Document extends Model
{
    protected $table = 'documents';

    protected $fillable = [
        'uuid',
        'name',
        'type',
        'path',
        'data',
        'sort_id',
        'is_folder',
        'folder_uuid',
        'user_id',
    ];

    public function folder()
    {
        return $this->hasOne('App\Folder', 'folder_id');
    }
}
