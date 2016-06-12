<?php

namespace Xentry\Models;

use Illuminate\Database\Eloquent\Model;

class Activity extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'activities';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'action', 'from_user_id', 'to_user_id'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [];

    /**
     * Disable updated_at timestamp
     */
    public function setUpdatedAt($value)
    {
    }

    /**
     * User that activity was triggered by
     */
    public function fromUser()
    {
        return $this->belongsTo('Xentry\Models\User', 'from_user_id');
    }

    /**
     * Sort desc
     */
    public function scopeDesc($query)
    {
        $query->orderBy('created_at', 'desc');
    }
}
