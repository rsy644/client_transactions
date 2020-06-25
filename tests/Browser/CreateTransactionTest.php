<?php

namespace Tests\Browser;

use Faker\Factory;

use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Support\Str;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;


class CreateTransactionTest extends DuskTestCase
{
    /**
     * Test for creating a dummy transaction with the transactions create form.
     *
     * @return void
     */

    use withFaker;

    public function testExample()
    {
        $this->browse(function (Browser $browser) {
            setup($browser);
            $date = $this->faker->date('d/m/Y');
            $browser->
            visit('/')
             ->click('ul.client_list li:first-child a')
             ->click('.admin-links a:nth-of-type(2)')
             ->type('transaction_date', $date)
             ->type('amount', $this->faker->numberBetween(0, 10000))
             ->click('input.submit')
             ->assertSee('Transaction has been created')
             ->assertSee($date);                   
        });
    }
}
