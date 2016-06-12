<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class GeneralTest extends TestCase
{
    public function testUnloggedUserIsRedirectedToLoginPage()
    {
        $this->visit('/users')->see('Login');
        $this->visit('/users/2')->see('Login');
    }
}
