<?php

namespace Tests\Unit;

use Tests\TestCase;

class customerTest extends TestCase
{
    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function test_login_form()
    {
       $responce = $this->get('login');

       $responce->assertStatus(200);
    }
}
