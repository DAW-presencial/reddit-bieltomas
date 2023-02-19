<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\Comunidad;
use Laravel\Sanctum\Sanctum;
use App\Models\User;

class ComunidadTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */

    use RefreshDatabase;


    /**
     * @test
     */
    public function test_can_fetch_all_comunidades()
    {
        Comunidad::factory()->count(5)->create();

        $response = $this->getJson(route('comunidades.index'));

        $response->assertOk();
    }

    /**
     * @test
     */
    public function test_can_fetch_comunidad()
    {
        $comunidad = Comunidad::factory()->create();

        $response = $this->getJson(route('comunidades.show', $comunidad));

        $response->assertOk();
    }

    /**
     * @test
     */
    public function test_can_create_comunidad()
    {
        Sanctum::actingAs(User::factory()->create());

        $response = $this->postJson(route('comunidades.store'), [
            'nombre' => 'Comunidad de prueba',
            'descripcion' => 'Comunidad de prueba',
        ]);

        $response->assertCreated();
    }

    /**
     * @test
     */
    public function test_guests_can_not_create_comunidad()
    {
        $response = $this->postJson(route('comunidades.store'), [
            'nombre' => 'Comunidad de prueba',
            'descripcion' => 'Comunidad de prueba',
        ]);

        $response->assertUnauthorized();
    }

    /**
     * @test
     */
    public function test_can_update_comunidad()
    {
        Sanctum::actingAs(User::factory()->create());

        $comunidad = Comunidad::factory()->create();

        $response = $this->putJson(route('comunidades.update', $comunidad), [
            'nombre' => 'Comunidad de prueba',
            'descripcion' => 'Comunidad de prueba',
        ]);

        $response->assertOk();
    }

    /**
     * @test
     */
    public function test_can_delete_comunidad()
    {
        Sanctum::actingAs(User::factory()->create());

        $comunidad = Comunidad::factory()->create();

        $response = $this->deleteJson(route('comunidades.destroy', $comunidad));

        $response->assertNoContent();
    }

    /**
     * @test
     */
    public function test_can_returns_a_json_api_error_when_comunidad_not_found()
    {
        $response = $this->getJson(route('comunidades.show', 999));

        $response->assertJsonStructure([
            'error'
        ]);
    }
}
