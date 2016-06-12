<?php

namespace Xentry\Models;

use Auth;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token', 'avatar_file', 'theme'
    ];

    /**
     * Followers
     */
    public function followers()
    {
        return $this->belongsToMany('Xentry\Models\User', 'follow_refs', 'user_id', 'follower_id');
    }

    /**
     * Followings
     */
    public function followings()
    {
        return $this->belongsToMany('Xentry\Models\User', 'follow_refs', 'follower_id', 'user_id');
    }

    /**
     * Current use following reference
     */
    public function currentUserFollowing()
    {
        return $this->hasOne('Xentry\Models\FollowRef', 'user_id', 'id');
    }

    /**
     * Include other user (eg. current user) following
     *
     * @param Illuminate\Database\Eloquent\Builder $query
     * @param int $current_user_id
     */
    public function scopeWithCurrentUserFollowing($query)
    {
        $query->with(
            [
                'currentUserFollowing' => function ($query) {
                    $current_user_id = Auth::user()->id;

                    $query->where('follow_refs.follower_id', $current_user_id);
                }
            ]
        );

        return $query;
    }

    /**
     * User activities
     */
    public function activities()
    {
        return $this->hasMany('Xentry\Models\Activity', 'to_user_id');
    }

    /**
     * Is following given user?
     *
     * @param int $user_id
     * @return bool
     */
    public function isFollowing($user_id)
    {
        $current_user_id = Auth::user()->id;

        $followRefNum = FollowRef::where('user_id', $user_id)->where('follower_id', $current_user_id)->count();

        return ($followRefNum > 0);
    }
}
