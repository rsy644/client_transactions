<?php

namespace Tests\Browser;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class LoginTest extends DuskTestCase
{
    /**
     * Test that the user can login via the login form and access the welcome page.
     *
     * @return void
     */
    public function testExample()
    {
        $this->browse(function (Browser $browser) {
            setup($browser);
            $browser->assertSee('Clients');
        });
    }
}
