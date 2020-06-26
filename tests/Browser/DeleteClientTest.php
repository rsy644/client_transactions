<?php

namespace Tests\Browser;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class DeleteClientTest extends DuskTestCase
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
            $value = $browser->value('ul.client_list li:first-child a');

            $browser->click('ul.client_list li:first-child span[class="delete_x"]')
            ->assertSee('Are you sure you want to delete')
            ->click('button[class="delete_button btn btn-default"]')
            ->assertDontSee($value);
        });
    }
}
