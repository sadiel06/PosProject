<?php

namespace Tests\Feature\Http\Controllers;

use App\Models\Client;
use App\Models\Entity;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use JMac\Testing\Traits\AdditionalAssertions;
use Tests\TestCase;

/**
 * @see \App\Http\Controllers\ClientController
 */
class ClientControllerTest extends TestCase
{
    use AdditionalAssertions, RefreshDatabase, WithFaker;

    /**
     * @test
     */
    public function index_displays_view()
    {
        $clients = Client::factory()->count(3)->create();

        $response = $this->get(route('client.index'));

        $response->assertOk();
        $response->assertViewIs('client.index');
        $response->assertViewHas('clients');
    }


    /**
     * @test
     */
    public function create_displays_view()
    {
        $response = $this->get(route('client.create'));

        $response->assertOk();
        $response->assertViewIs('client.create');
    }


    /**
     * @test
     */
    public function store_uses_form_request_validation()
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\ClientController::class,
            'store',
            \App\Http\Requests\ClientStoreRequest::class
        );
    }

    /**
     * @test
     */
    public function store_saves_and_redirects()
    {
        $entity = Entity::factory()->create();
        $name = $this->faker->name;
        $apellido = $this->faker->word;
        $cedula = $this->faker->word;

        $response = $this->post(route('client.store'), [
            'entity_id' => $entity->id,
            'name' => $name,
            'apellido' => $apellido,
            'cedula' => $cedula,
        ]);

        $clients = Client::query()
            ->where('entity_id', $entity->id)
            ->where('name', $name)
            ->where('apellido', $apellido)
            ->where('cedula', $cedula)
            ->get();
        $this->assertCount(1, $clients);
        $client = $clients->first();

        $response->assertRedirect(route('client.index'));
        $response->assertSessionHas('client.id', $client->id);
    }


    /**
     * @test
     */
    public function show_displays_view()
    {
        $client = Client::factory()->create();

        $response = $this->get(route('client.show', $client));

        $response->assertOk();
        $response->assertViewIs('client.show');
        $response->assertViewHas('client');
    }


    /**
     * @test
     */
    public function edit_displays_view()
    {
        $client = Client::factory()->create();

        $response = $this->get(route('client.edit', $client));

        $response->assertOk();
        $response->assertViewIs('client.edit');
        $response->assertViewHas('client');
    }


    /**
     * @test
     */
    public function update_uses_form_request_validation()
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\ClientController::class,
            'update',
            \App\Http\Requests\ClientUpdateRequest::class
        );
    }

    /**
     * @test
     */
    public function update_redirects()
    {
        $client = Client::factory()->create();
        $entity = Entity::factory()->create();
        $name = $this->faker->name;
        $apellido = $this->faker->word;
        $cedula = $this->faker->word;

        $response = $this->put(route('client.update', $client), [
            'entity_id' => $entity->id,
            'name' => $name,
            'apellido' => $apellido,
            'cedula' => $cedula,
        ]);

        $client->refresh();

        $response->assertRedirect(route('client.index'));
        $response->assertSessionHas('client.id', $client->id);

        $this->assertEquals($entity->id, $client->entity_id);
        $this->assertEquals($name, $client->name);
        $this->assertEquals($apellido, $client->apellido);
        $this->assertEquals($cedula, $client->cedula);
    }


    /**
     * @test
     */
    public function destroy_deletes_and_redirects()
    {
        $client = Client::factory()->create();

        $response = $this->delete(route('client.destroy', $client));

        $response->assertRedirect(route('client.index'));

        $this->assertSoftDeleted($client);
    }
}
