<?php

namespace Xentry\Listeners;

/**
 * User is unfollowed -> notify about activity
 */
class UnfollowActivity extends AbstractActivity
{
    protected function getAction()
    {
        return 'unfollow';
    }
}
