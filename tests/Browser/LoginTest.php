<?php

namespace Tests\Browser;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;
use App\Models\User;

class LoginTest extends DuskTestCase
{
    //realizar las migraciones de la base de datos de prueba
    use DatabaseMigrations;
    /**
     * A Dusk test example.
     * 
     * @test
     * @throws \Throwable
     */
    public function registered_users_can_login(): void
    {
        //creacion de usuario autenticado con el email indicado
        $user = User::factory()->create(['email' => 'marana@continental.edu.pe']);
        $this->browse(function (Browser $browser) {
            $browser->visit('/login')
                    ->type('email','marana@continental.edu.pe')
                    ->type('password','password')
                    ->press('#login-btn')
                    ->assertAuthenticated();
        });
    }
}
