<?php

namespace Tests\Feature\Http\Controllers;

use App\Models\InventoryDetail;
use App\Models\Pruduct;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use JMac\Testing\Traits\AdditionalAssertions;
use Tests\TestCase;

/**
 * @see \App\Http\Controllers\InventoryDetailController
 */
class InventoryDetailControllerTest extends TestCase
{
    use AdditionalAssertions, RefreshDatabase, WithFaker;

    /**
     * @test
     */
    public function index_displays_view()
    {
        $inventoryDetails = InventoryDetail::factory()->count(3)->create();

        $response = $this->get(route('inventory-detail.index'));

        $response->assertOk();
        $response->assertViewIs('inventoryDetail.index');
        $response->assertViewHas('inventoryDetails');
    }


    /**
     * @test
     */
    public function create_displays_view()
    {
        $response = $this->get(route('inventory-detail.create'));

        $response->assertOk();
        $response->assertViewIs('inventoryDetail.create');
    }


    /**
     * @test
     */
    public function store_uses_form_request_validation()
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\InventoryDetailController::class,
            'store',
            \App\Http\Requests\InventoryDetailStoreRequest::class
        );
    }

    /**
     * @test
     */
    public function store_saves_and_redirects()
    {
        $pruduct = Pruduct::factory()->create();
        $min_stock = $this->faker->numberBetween(-10000, 10000);
        $current_stock = $this->faker->numberBetween(-10000, 10000);

        $response = $this->post(route('inventory-detail.store'), [
            'pruduct_id' => $pruduct->id,
            'min_stock' => $min_stock,
            'current_stock' => $current_stock,
        ]);

        $inventoryDetails = InventoryDetail::query()
            ->where('pruduct_id', $pruduct->id)
            ->where('min_stock', $min_stock)
            ->where('current_stock', $current_stock)
            ->get();
        $this->assertCount(1, $inventoryDetails);
        $inventoryDetail = $inventoryDetails->first();

        $response->assertRedirect(route('inventoryDetail.index'));
        $response->assertSessionHas('inventoryDetail.id', $inventoryDetail->id);
    }


    /**
     * @test
     */
    public function show_displays_view()
    {
        $inventoryDetail = InventoryDetail::factory()->create();

        $response = $this->get(route('inventory-detail.show', $inventoryDetail));

        $response->assertOk();
        $response->assertViewIs('inventoryDetail.show');
        $response->assertViewHas('inventoryDetail');
    }


    /**
     * @test
     */
    public function edit_displays_view()
    {
        $inventoryDetail = InventoryDetail::factory()->create();

        $response = $this->get(route('inventory-detail.edit', $inventoryDetail));

        $response->assertOk();
        $response->assertViewIs('inventoryDetail.edit');
        $response->assertViewHas('inventoryDetail');
    }


    /**
     * @test
     */
    public function update_uses_form_request_validation()
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\InventoryDetailController::class,
            'update',
            \App\Http\Requests\InventoryDetailUpdateRequest::class
        );
    }

    /**
     * @test
     */
    public function update_redirects()
    {
        $inventoryDetail = InventoryDetail::factory()->create();
        $pruduct = Pruduct::factory()->create();
        $min_stock = $this->faker->numberBetween(-10000, 10000);
        $current_stock = $this->faker->numberBetween(-10000, 10000);

        $response = $this->put(route('inventory-detail.update', $inventoryDetail), [
            'pruduct_id' => $pruduct->id,
            'min_stock' => $min_stock,
            'current_stock' => $current_stock,
        ]);

        $inventoryDetail->refresh();

        $response->assertRedirect(route('inventoryDetail.index'));
        $response->assertSessionHas('inventoryDetail.id', $inventoryDetail->id);

        $this->assertEquals($pruduct->id, $inventoryDetail->pruduct_id);
        $this->assertEquals($min_stock, $inventoryDetail->min_stock);
        $this->assertEquals($current_stock, $inventoryDetail->current_stock);
    }


    /**
     * @test
     */
    public function destroy_deletes_and_redirects()
    {
        $inventoryDetail = InventoryDetail::factory()->create();

        $response = $this->delete(route('inventory-detail.destroy', $inventoryDetail));

        $response->assertRedirect(route('inventoryDetail.index'));

        $this->assertDeleted($inventoryDetail);
    }
}
