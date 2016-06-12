<?php

namespace Xentry\Providers;

use Illuminate\Contracts\Events\Dispatcher as DispatcherContract;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        'Xentry\Events\UserFollowed' => [
            'Xentry\Listeners\FollowEmail',
            'Xentry\Listeners\FollowActivity'
        ],
        'Xentry\Events\UserUnfollowed' => [
            'Xentry\Listeners\UnfollowActivity'
        ],
    ];

    /**
     * Register any other events for your application.
     *
     * @param  \Illuminate\Contracts\Events\Dispatcher  $events
     * @return void
     */
    public function boot(DispatcherContract $events)
    {
        parent::boot($events);

        //
    }
}
