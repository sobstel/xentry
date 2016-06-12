<?php

namespace Xentry\Http\Controllers;

use Auth;
use Event;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Xentry\Events\UserFollowed;
use Xentry\Events\UserUnfollowed;
use Xentry\Models\Activity;
use Xentry\Models\User;

/**
 * Users controller
 */
class UsersController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show all users
     *
     * @return Response
     */
    public function index()
    {
        $users = User::withCurrentUserFollowing()->get();

        return view('users/index', ['users' => $users]);
    }

    /**
     * Show single user
     *
     * @param int $user_id
     * @return Response
     */
    public function show($user_id)
    {
        $current_user_id = Auth::user()->id;

        $user = User::where('id', $user_id)
            ->withCurrentUserFollowing()
            ->with('followers')
            ->with(['activities' => function($query) {
                $query->with('fromUser')->desc();
            }])
            ->first();

        if (!$user) {
            abort(404, 'user not found');
        }

        return view('users/show', ['user' => $user]);
    }

    /**
     * Follow the other user
     *
     * @param int $user_id
     * @return Response
     */
    public function follow($user_id)
    {
        if ($user_id == Auth::user()->id) {
            return redirect()->back()->with('error', 'You cannot follow yourself!');
        }

        if (Auth::user()->isFollowing($user_id)) {
            return redirect()->back()->with('error', 'You\'re already following this user!');
        }

        $user = User::find($user_id);
        $user->followers()->attach(Auth::user(), ['created_at' => 'NOW()']);
        $user->save();

        Event::fire(new UserFollowed($user_id, Auth::user()->id));

        return redirect()->back()->with('success', sprintf('You\'re now following %s!', $user->name));
    }

    /**
     * Unfollow the other user
     *
     * @param int $user_id
     * @return Response
     */
    public function unfollow($user_id)
    {
        if (!Auth::user()->isFollowing($user_id)) {
            return redirect()->back()->with('error', 'You\'re not following this user!');
        }

        $user = User::find($user_id);
        $user->followers()->detach(Auth::user());
        $user->save();

        Event::fire(new UserUnfollowed($user_id, Auth::user()->id));

        return redirect()->back()->with('success', sprintf('You\'re not following %s anymore!', $user->name));
    }
}
