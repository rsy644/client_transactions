<?php

namespace Tests\Browser;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class CreateClientTest extends DuskTestCase
{
    /**
     * A Dusk test example.
     *
     * @return void
     */

    public function testExample()
    {
        $this->browse(function (Browser $browser) {
            setup($browser); // logs user into the application
            $browser->visit('/clients/create')
            ->type('first_name', 'Texaco')
            ->type('last_name', 'Garage')
            ->type('avatar', 'C:\Users\Rob\Documents\Development\logos\starbucks.jpg')
            ->type('email', 'texaco@hotmail.com')
            ->click('input[type="submit"]')
            ->assertSee('Texaco Garage'); // asserts it can see the Texaco garage entry on the client listing page.
        });
    }


}
