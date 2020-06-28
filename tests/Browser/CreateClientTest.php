<?php

namespace Tests\Browser;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Support\Str;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class CreateClientTest extends DuskTestCase
{
    /**
     * Test for creating a dummy client using the client create form.
     *
     * @return void
     */

    public function testExample()
    {
        $this->browse(function (Browser $browser) {
            setup($browser); // logs user into the application
            $first_name = Str::random(6);
            $last_name = Str::random(10);
            $email = Str::random(5);
            $browser->visit('/clients/create')
            ->type('first_name', $first_name)
            ->type('last_name', $last_name)
            ->attach('avatar', storage_path('app/public/shell_logo.png'))
            ->type('email', $email . '@hotmail.com')
            ->click('input[type="submit"]')
            ->assertSee($first_name . ' ' . $last_name); // asserts it can see the Texaco garage entry on the client listing page.
        });
    }


}
