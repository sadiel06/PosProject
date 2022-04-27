<?php

namespace Tests\Feature\Http\Controllers;

use App\Models\Address;
use App\Models\Municipality;
use App\Models\Region;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use JMac\Testing\Traits\AdditionalAssertions;
use Tests\TestCase;

/**
 * @see \App\Http\Controllers\AddressController
 */
class AddressControllerTest extends TestCase
{
    use AdditionalAssertions, RefreshDatabase, WithFaker;

    /**
     * @test
     */
    public function index_displays_view()
    {
        $addresses = Address::factory()->count(3)->create();

        $response = $this->get(route('address.index'));

        $response->assertOk();
        $response->assertViewIs('address.index');
        $response->assertViewHas('addresses');
    }


    /**
     * @test
     */
    public function create_displays_view()
    {
        $response = $this->get(route('address.create'));

        $response->assertOk();
        $response->assertViewIs('address.create');
    }


    /**
     * @test
     */
    public function store_uses_form_request_validation()
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\AddressController::class,
            'store',
            \App\Http\Requests\AddressStoreRequest::class
        );
    }

    /**
     * @test
     */
    public function store_saves_and_redirects()
    {
        $region = Region::factory()->create();
        $province_id = $this->faker->word;
        $municipality = Municipality::factory()->create();

        $response = $this->post(route('address.store'), [
            'region_id' => $region->id,
            'province_id' => $province_id,
            'municipality_id' => $municipality->id,
        ]);

        $addresses = Address::query()
            ->where('region_id', $region->id)
            ->where('province_id', $province_id)
            ->where('municipality_id', $municipality->id)
            ->get();
        $this->assertCount(1, $addresses);
        $address = $addresses->first();

        $response->assertRedirect(route('address.index'));
        $response->assertSessionHas('address.id', $address->id);
    }


    /**
     * @test
     */
    public function show_displays_view()
    {
        $address = Address::factory()->create();

        $response = $this->get(route('address.show', $address));

        $response->assertOk();
        $response->assertViewIs('address.show');
        $response->assertViewHas('address');
    }


    /**
     * @test
     */
    public function edit_displays_view()
    {
        $address = Address::factory()->create();

        $response = $this->get(route('address.edit', $address));

        $response->assertOk();
        $response->assertViewIs('address.edit');
        $response->assertViewHas('address');
    }


    /**
     * @test
     */
    public function update_uses_form_request_validation()
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\AddressController::class,
            'update',
            \App\Http\Requests\AddressUpdateRequest::class
        );
    }

    /**
     * @test
     */
    public function update_redirects()
    {
        $address = Address::factory()->create();
        $region = Region::factory()->create();
        $province_id = $this->faker->word;
        $municipality = Municipality::factory()->create();

        $response = $this->put(route('address.update', $address), [
            'region_id' => $region->id,
            'province_id' => $province_id,
            'municipality_id' => $municipality->id,
        ]);

        $address->refresh();

        $response->assertRedirect(route('address.index'));
        $response->assertSessionHas('address.id', $address->id);

        $this->assertEquals($region->id, $address->region_id);
        $this->assertEquals($province_id, $address->province_id);
        $this->assertEquals($municipality->id, $address->municipality_id);
    }


    /**
     * @test
     */
    public function destroy_deletes_and_redirects()
    {
        $address = Address::factory()->create();

        $response = $this->delete(route('address.destroy', $address));

        $response->assertRedirect(route('address.index'));

        $this->assertSoftDeleted($address);
    }
}
