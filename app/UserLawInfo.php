<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserLawInfo extends Model
{
    protected $table = 'user_law_info';
    protected $primaryKey = 'user_id';
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
        'user_id', 'state_of_bar', 'bar_number', 'practice_areas', 'education', 'experience', 'focus', 'title'
    ];

    public function user()
    {
        return $this->belongsTo('App\User');
    }

}
