<?php

namespace Xentry\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Follow reference (users <-> follow_ref (user_id, follower_id) <-> users)
 */
class FollowRef extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'follow_refs';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id', 'follower_id'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [];

    // public fun

    /**
     * Disable updated_at timestamp
     */
    public function setUpdatedAt($value)
    {
    }
}
