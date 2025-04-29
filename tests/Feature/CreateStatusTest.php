<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class CreateStatusTest extends TestCase
{
    //realizar la migraciones para un DATABASE en memoria
    use RefreshDatabase;
    //prueba para invalidar la creacion de un estado    
    /** @test */
    public function guests_users_can_not_create_status() 
    {
        //1. GIVEN -> TENIENDO UN USUARIO NO AUTENTICADO
        //como es uno no autentificado entonces no es necesario colocar algo aqui
        //2. WHEN -> CUANDO HACE UN POST REQUEST A STATUS
        $response = $this->post(route('status.store'), ['body' => 'Mi primer estado publicado']);
        //3. THEN -> ENTONCES DEBE REDIRECCIONAR A LA PAGINA DE INICIO
        $response->assertRedirect('login');
    }
    
    //prueba para crear un estado desde un usuario logueado   
    /** @test */
    public function an_authenticated_user_can_create_status()
    {
        //Quitar el manejo de errores
        $this->withoutExceptionHandling();
        
        //1.GIVEN ->TENIENDO UN USUARIO AUTENTICADO

        //1.1. CREAR UN NUEVO USUARIO DESDE FACTORY
        $user = User::factory()->create();
        //1.2. AUTENTICAR AL USUARIO
        $this->actingAs($user);
        //2. WHEN -> CUANDO HACE UN POST REQUEST A STATUS

        //2.1hacer el post deseado dentro de la ruta asignada
        $response = $this->post(route('status.store'), ['body' => 'Mi primer estado publicado']);
        //2.2Redireccionar la interfaz una vez regitrado el estado||debe redireccionar al index principal
        $response->assertJson([
            'body' => 'Mi primer estado publicado',
    
        /*//3. THEN -> ENTONCES DEBE REDIRECCIONAR A LA PAGINA DE INICIO
        $this->assertDatabaseHas('statuses', [
            'user_id' => $user->id,
            'body' => 'Mi primer estado publicado',*/
        ]);
    }    
    /* LAB10 */
    //prueba para invalidar el BODY al crear un Estado    
    /** @test */
    public function a_status_requires_a_body() 
    {
        //1. GIVEN -> TENIENDO UN USUARIO AUTENTICADO
        $user = User::factory()->create();
        $this->actingAs($user);

        //2. WHEN -> CUANDO HACE UN POST (create) request a status
        $response = $this->post(route('status.store'), ['body' => '']);
        //3. THEN -> ENTONCES DEBE REDIRECCIONAR A LA PAGINA DE INICIO
        $response->assertRedirect(url('/')); // respeta tu base URL
        $response->assertSessionHasErrors(['body']);
    }
    /* LAB10 */
    //prueba para validar el minimo de contenido del BODY al crear un Estado    
    /** @test */
    public function a_status_body_requires_a_minimum_length() 
    {
        //1. GIVEN -> TENIENDO UN USUARIO AUTENTICADO
        $user = User::factory()->create();
        $this->actingAs($user);

        //2. WHEN -> CUANDO HACE UN POST (create) request a status con 10 caracteres    
        $response = $this->postJson(route('status.store'), ['body' => 'asfa ssfa']);
        $response->assertStatus(422);
        //3. THEN -> ENTONCES veo un nuevo estado en la base de datos   
        $response->assertJsonStructure(['message', 'errors' => ['body']]);
    }

}
