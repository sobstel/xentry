<?php

namespace Xentry\Listeners;

/**
 * User gets a new follower -> notify about activity
 */
class FollowActivity extends AbstractActivity
{
    protected function getAction()
    {
        return 'follow';
    }
}
