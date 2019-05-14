<?php

namespace Tests\Browser;

use App\User;
use Tests\DuskTestCase;
use Laravel\Dusk\Browser;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class LoginTest extends DuskTestCase
{
    use DatabaseMigrations;
    /**
     * @group login
     *
     * @return void
     */
    public function testAUserCanLogin()
    {
        $user = factory(User::class)->create();

        $this->browse(function (Browser $browser) use ($user){
           $browser->visit('/login')
           ->type('email', $user->email)
           ->type('password', 'password')
           ->press('Login')
           ->assertPathIs('/home');
        });
    }
}
