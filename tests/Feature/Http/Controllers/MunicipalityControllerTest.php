<?php

namespace Tests\Feature\Http\Controllers;

use App\Models\Municipality;
use App\Models\Province;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use JMac\Testing\Traits\AdditionalAssertions;
use Tests\TestCase;

/**
 * @see \App\Http\Controllers\MunicipalityController
 */
class MunicipalityControllerTest extends TestCase
{
    use AdditionalAssertions, RefreshDatabase, WithFaker;

    /**
     * @test
     */
    public function index_displays_view()
    {
        $municipalities = Municipality::factory()->count(3)->create();

        $response = $this->get(route('municipality.index'));

        $response->assertOk();
        $response->assertViewIs('municipality.index');
        $response->assertViewHas('municipalities');
    }


    /**
     * @test
     */
    public function create_displays_view()
    {
        $response = $this->get(route('municipality.create'));

        $response->assertOk();
        $response->assertViewIs('municipality.create');
    }


    /**
     * @test
     */
    public function store_uses_form_request_validation()
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\MunicipalityController::class,
            'store',
            \App\Http\Requests\MunicipalityStoreRequest::class
        );
    }

    /**
     * @test
     */
    public function store_saves_and_redirects()
    {
        $description = $this->faker->text;
        $province = Province::factory()->create();

        $response = $this->post(route('municipality.store'), [
            'description' => $description,
            'province_id' => $province->id,
        ]);

        $municipalities = Municipality::query()
            ->where('description', $description)
            ->where('province_id', $province->id)
            ->get();
        $this->assertCount(1, $municipalities);
        $municipality = $municipalities->first();

        $response->assertRedirect(route('municipality.index'));
        $response->assertSessionHas('municipality.id', $municipality->id);
    }


    /**
     * @test
     */
    public function show_displays_view()
    {
        $municipality = Municipality::factory()->create();

        $response = $this->get(route('municipality.show', $municipality));

        $response->assertOk();
        $response->assertViewIs('municipality.show');
        $response->assertViewHas('municipality');
    }


    /**
     * @test
     */
    public function edit_displays_view()
    {
        $municipality = Municipality::factory()->create();

        $response = $this->get(route('municipality.edit', $municipality));

        $response->assertOk();
        $response->assertViewIs('municipality.edit');
        $response->assertViewHas('municipality');
    }


    /**
     * @test
     */
    public function update_uses_form_request_validation()
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\MunicipalityController::class,
            'update',
            \App\Http\Requests\MunicipalityUpdateRequest::class
        );
    }

    /**
     * @test
     */
    public function update_redirects()
    {
        $municipality = Municipality::factory()->create();
        $description = $this->faker->text;
        $province = Province::factory()->create();

        $response = $this->put(route('municipality.update', $municipality), [
            'description' => $description,
            'province_id' => $province->id,
        ]);

        $municipality->refresh();

        $response->assertRedirect(route('municipality.index'));
        $response->assertSessionHas('municipality.id', $municipality->id);

        $this->assertEquals($description, $municipality->description);
        $this->assertEquals($province->id, $municipality->province_id);
    }


    /**
     * @test
     */
    public function destroy_deletes_and_redirects()
    {
        $municipality = Municipality::factory()->create();

        $response = $this->delete(route('municipality.destroy', $municipality));

        $response->assertRedirect(route('municipality.index'));

        $this->assertSoftDeleted($municipality);
    }
}
