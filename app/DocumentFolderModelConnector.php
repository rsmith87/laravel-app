<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DocumentFolderModelConnector extends Model
{
    public $fillable = [
        'model_type',
        'model_id',
        'document_id',
        'folder_id',
    ];
}
