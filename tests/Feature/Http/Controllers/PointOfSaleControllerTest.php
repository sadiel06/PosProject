<?php

namespace Tests\Feature\Http\Controllers;

use App\Models\Address;
use App\Models\PointOfSale;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use JMac\Testing\Traits\AdditionalAssertions;
use Tests\TestCase;

/**
 * @see \App\Http\Controllers\PointOfSaleController
 */
class PointOfSaleControllerTest extends TestCase
{
    use AdditionalAssertions, RefreshDatabase, WithFaker;

    /**
     * @test
     */
    public function index_displays_view()
    {
        $pointOfSales = PointOfSale::factory()->count(3)->create();

        $response = $this->get(route('point-of-sale.index'));

        $response->assertOk();
        $response->assertViewIs('pointOfSale.index');
        $response->assertViewHas('pointOfSales');
    }


    /**
     * @test
     */
    public function create_displays_view()
    {
        $response = $this->get(route('point-of-sale.create'));

        $response->assertOk();
        $response->assertViewIs('pointOfSale.create');
    }


    /**
     * @test
     */
    public function store_uses_form_request_validation()
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\PointOfSaleController::class,
            'store',
            \App\Http\Requests\PointOfSaleStoreRequest::class
        );
    }

    /**
     * @test
     */
    public function store_saves_and_redirects()
    {
        $name = $this->faker->name;
        $user = User::factory()->create();
        $address = Address::factory()->create();

        $response = $this->post(route('point-of-sale.store'), [
            'name' => $name,
            'user_id' => $user->id,
            'address_id' => $address->id,
        ]);

        $pointOfSales = PointOfSale::query()
            ->where('name', $name)
            ->where('user_id', $user->id)
            ->where('address_id', $address->id)
            ->get();
        $this->assertCount(1, $pointOfSales);
        $pointOfSale = $pointOfSales->first();

        $response->assertRedirect(route('pointOfSale.index'));
        $response->assertSessionHas('pointOfSale.id', $pointOfSale->id);
    }


    /**
     * @test
     */
    public function show_displays_view()
    {
        $pointOfSale = PointOfSale::factory()->create();

        $response = $this->get(route('point-of-sale.show', $pointOfSale));

        $response->assertOk();
        $response->assertViewIs('pointOfSale.show');
        $response->assertViewHas('pointOfSale');
    }


    /**
     * @test
     */
    public function edit_displays_view()
    {
        $pointOfSale = PointOfSale::factory()->create();

        $response = $this->get(route('point-of-sale.edit', $pointOfSale));

        $response->assertOk();
        $response->assertViewIs('pointOfSale.edit');
        $response->assertViewHas('pointOfSale');
    }


    /**
     * @test
     */
    public function update_uses_form_request_validation()
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\PointOfSaleController::class,
            'update',
            \App\Http\Requests\PointOfSaleUpdateRequest::class
        );
    }

    /**
     * @test
     */
    public function update_redirects()
    {
        $pointOfSale = PointOfSale::factory()->create();
        $name = $this->faker->name;
        $user = User::factory()->create();
        $address = Address::factory()->create();

        $response = $this->put(route('point-of-sale.update', $pointOfSale), [
            'name' => $name,
            'user_id' => $user->id,
            'address_id' => $address->id,
        ]);

        $pointOfSale->refresh();

        $response->assertRedirect(route('pointOfSale.index'));
        $response->assertSessionHas('pointOfSale.id', $pointOfSale->id);

        $this->assertEquals($name, $pointOfSale->name);
        $this->assertEquals($user->id, $pointOfSale->user_id);
        $this->assertEquals($address->id, $pointOfSale->address_id);
    }


    /**
     * @test
     */
    public function destroy_deletes_and_redirects()
    {
        $pointOfSale = PointOfSale::factory()->create();

        $response = $this->delete(route('point-of-sale.destroy', $pointOfSale));

        $response->assertRedirect(route('pointOfSale.index'));

        $this->assertSoftDeleted($pointOfSale);
    }
}
