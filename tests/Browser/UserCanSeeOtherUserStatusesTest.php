<?php

namespace Tests\Browser;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;
use App\Models\User;
use App\Models\Status;

class UserCanSeeOtherUserStatusesTest extends DuskTestCase
{
    use DatabaseMigrations;

    /**
     * @test
     * @throws \Throwable
     */
    public function user_can_see_statuses_from_other_users()
    {
        // Usuario A publica un estado
        $userA = User::factory()->create(['name' => 'Juan']);
        $status = Status::create([
            'user_id' => $userA->id,
            'body' => 'Este es un estado de prueba de Juan',
        ]);

        // Usuario B inicia sesión
        $userB = User::factory()->create();

        $this->browse(function (Browser $browser) use ($userB, $status) {
            $browser->loginAs($userB)
                    ->visit('/statuses')
                    ->assertSee('Este es un estado de prueba de Juan')
                    ->assertSee('Juan dijo: "Este es un estado de prueba de Juan"');
        });
    }
}
