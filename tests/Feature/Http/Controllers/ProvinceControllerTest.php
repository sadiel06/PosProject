<?php

namespace Tests\Feature\Http\Controllers;

use App\Models\Province;
use App\Models\Region;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use JMac\Testing\Traits\AdditionalAssertions;
use Tests\TestCase;

/**
 * @see \App\Http\Controllers\ProvinceController
 */
class ProvinceControllerTest extends TestCase
{
    use AdditionalAssertions, RefreshDatabase, WithFaker;

    /**
     * @test
     */
    public function index_displays_view()
    {
        $provinces = Province::factory()->count(3)->create();

        $response = $this->get(route('province.index'));

        $response->assertOk();
        $response->assertViewIs('province.index');
        $response->assertViewHas('provinces');
    }


    /**
     * @test
     */
    public function create_displays_view()
    {
        $response = $this->get(route('province.create'));

        $response->assertOk();
        $response->assertViewIs('province.create');
    }


    /**
     * @test
     */
    public function store_uses_form_request_validation()
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\ProvinceController::class,
            'store',
            \App\Http\Requests\ProvinceStoreRequest::class
        );
    }

    /**
     * @test
     */
    public function store_saves_and_redirects()
    {
        $description = $this->faker->text;
        $region = Region::factory()->create();

        $response = $this->post(route('province.store'), [
            'description' => $description,
            'region_id' => $region->id,
        ]);

        $provinces = Province::query()
            ->where('description', $description)
            ->where('region_id', $region->id)
            ->get();
        $this->assertCount(1, $provinces);
        $province = $provinces->first();

        $response->assertRedirect(route('province.index'));
        $response->assertSessionHas('province.id', $province->id);
    }


    /**
     * @test
     */
    public function show_displays_view()
    {
        $province = Province::factory()->create();

        $response = $this->get(route('province.show', $province));

        $response->assertOk();
        $response->assertViewIs('province.show');
        $response->assertViewHas('province');
    }


    /**
     * @test
     */
    public function edit_displays_view()
    {
        $province = Province::factory()->create();

        $response = $this->get(route('province.edit', $province));

        $response->assertOk();
        $response->assertViewIs('province.edit');
        $response->assertViewHas('province');
    }


    /**
     * @test
     */
    public function update_uses_form_request_validation()
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\ProvinceController::class,
            'update',
            \App\Http\Requests\ProvinceUpdateRequest::class
        );
    }

    /**
     * @test
     */
    public function update_redirects()
    {
        $province = Province::factory()->create();
        $description = $this->faker->text;
        $region = Region::factory()->create();

        $response = $this->put(route('province.update', $province), [
            'description' => $description,
            'region_id' => $region->id,
        ]);

        $province->refresh();

        $response->assertRedirect(route('province.index'));
        $response->assertSessionHas('province.id', $province->id);

        $this->assertEquals($description, $province->description);
        $this->assertEquals($region->id, $province->region_id);
    }


    /**
     * @test
     */
    public function destroy_deletes_and_redirects()
    {
        $province = Province::factory()->create();

        $response = $this->delete(route('province.destroy', $province));

        $response->assertRedirect(route('province.index'));

        $this->assertSoftDeleted($province);
    }
}
