<?php

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

if (! function_exists('setup')) {
	function setup(Browser $browser){
			$browser->visit('/logout')
            ->value('#email', 'admin@admin.com')
            ->value('#password', 'password')
            ->click('button[type="submit"]');

	}
}

?>