<?php

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

/* For use with Laravel Dusk testing - logs the browser out of wherever it is on the app and logs in with the default email and password credentials. */

if (! function_exists('setup')) {
	function setup(Browser $browser){
			$browser->visit('/logout')
            ->value('#email', 'admin@admin.com')
            ->value('#password', 'password')
            ->click('button[type="submit"]');

	}
}


if (! function_exists('logout')) {
    function logout(){
        Auth::logout();
        return redirect('/');
    }
}

?>