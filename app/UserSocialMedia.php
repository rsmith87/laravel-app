<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserSocialMedia extends Model
{
    protected $table = 'user_social_media';

    protected $primaryKey = 'user_id';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'fb', 'twitter', 'instagram', 'avvo', 'user_id',
    ];

    public function user()
    {
        return $this->belongsTo('App\User');
    }
}
