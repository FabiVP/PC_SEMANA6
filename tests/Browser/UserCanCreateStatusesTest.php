<?php

namespace Tests\Browser;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;
use App\Models\User;

class UserCanCreateStatusesTest extends DuskTestCase
{
    // Método para migrar la base de datos antes de iniciar la prueba de navegabilidad
    use DatabaseMigrations;

    /**
     * A Dusk test example.
     * 
     * @test
     * @throws \Throwable
     */
    public function users_can_create_statuses()
    {
    $user = User::factory()->create();

    $this->browse(function (Browser $browser) use ($user) {
        $browser->loginAs($user)
                ->visit('/statuses/create')
                ->type('textarea[name="body"]', 'Mi primer estado publicado')
                ->press('#create_status')
                ->screenshot('create-status')
                ->assertSee('Lista de Estados')  // Verifica que estamos en el índice
                ->assertSee('Mi primer estado publicado') // El estado nuevo
                ->assertSee('Estado creado exitosamente!'); // Mensaje de éxito
    });
    }
}
