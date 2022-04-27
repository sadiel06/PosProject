<?php

namespace Tests\Feature\Http\Controllers;

use App\Models\Product;
use App\Models\Sale;
use App\Models\SalesDetail;
use Carbon\Carbon;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use JMac\Testing\Traits\AdditionalAssertions;
use Tests\TestCase;

/**
 * @see \App\Http\Controllers\SalesDetailController
 */
class SalesDetailControllerTest extends TestCase
{
    use AdditionalAssertions, RefreshDatabase, WithFaker;

    /**
     * @test
     */
    public function index_displays_view()
    {
        $salesDetails = SalesDetail::factory()->count(3)->create();

        $response = $this->get(route('sales-detail.index'));

        $response->assertOk();
        $response->assertViewIs('salesDetail.index');
        $response->assertViewHas('salesDetails');
    }


    /**
     * @test
     */
    public function create_displays_view()
    {
        $response = $this->get(route('sales-detail.create'));

        $response->assertOk();
        $response->assertViewIs('salesDetail.create');
    }


    /**
     * @test
     */
    public function store_uses_form_request_validation()
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\SalesDetailController::class,
            'store',
            \App\Http\Requests\SalesDetailStoreRequest::class
        );
    }

    /**
     * @test
     */
    public function store_saves_and_redirects()
    {
        $sale = Sale::factory()->create();
        $date_created = $this->faker->date();
        $product = Product::factory()->create();
        $quantity = $this->faker->numberBetween(-10000, 10000);

        $response = $this->post(route('sales-detail.store'), [
            'sale_id' => $sale->id,
            'date_created' => $date_created,
            'product_id' => $product->id,
            'quantity' => $quantity,
        ]);

        $salesDetails = SalesDetail::query()
            ->where('sale_id', $sale->id)
            ->where('date_created', $date_created)
            ->where('product_id', $product->id)
            ->where('quantity', $quantity)
            ->get();
        $this->assertCount(1, $salesDetails);
        $salesDetail = $salesDetails->first();

        $response->assertRedirect(route('salesDetail.index'));
        $response->assertSessionHas('salesDetail.id', $salesDetail->id);
    }


    /**
     * @test
     */
    public function show_displays_view()
    {
        $salesDetail = SalesDetail::factory()->create();

        $response = $this->get(route('sales-detail.show', $salesDetail));

        $response->assertOk();
        $response->assertViewIs('salesDetail.show');
        $response->assertViewHas('salesDetail');
    }


    /**
     * @test
     */
    public function edit_displays_view()
    {
        $salesDetail = SalesDetail::factory()->create();

        $response = $this->get(route('sales-detail.edit', $salesDetail));

        $response->assertOk();
        $response->assertViewIs('salesDetail.edit');
        $response->assertViewHas('salesDetail');
    }


    /**
     * @test
     */
    public function update_uses_form_request_validation()
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\SalesDetailController::class,
            'update',
            \App\Http\Requests\SalesDetailUpdateRequest::class
        );
    }

    /**
     * @test
     */
    public function update_redirects()
    {
        $salesDetail = SalesDetail::factory()->create();
        $sale = Sale::factory()->create();
        $date_created = $this->faker->date();
        $product = Product::factory()->create();
        $quantity = $this->faker->numberBetween(-10000, 10000);

        $response = $this->put(route('sales-detail.update', $salesDetail), [
            'sale_id' => $sale->id,
            'date_created' => $date_created,
            'product_id' => $product->id,
            'quantity' => $quantity,
        ]);

        $salesDetail->refresh();

        $response->assertRedirect(route('salesDetail.index'));
        $response->assertSessionHas('salesDetail.id', $salesDetail->id);

        $this->assertEquals($sale->id, $salesDetail->sale_id);
        $this->assertEquals(Carbon::parse($date_created), $salesDetail->date_created);
        $this->assertEquals($product->id, $salesDetail->product_id);
        $this->assertEquals($quantity, $salesDetail->quantity);
    }


    /**
     * @test
     */
    public function destroy_deletes_and_redirects()
    {
        $salesDetail = SalesDetail::factory()->create();

        $response = $this->delete(route('sales-detail.destroy', $salesDetail));

        $response->assertRedirect(route('salesDetail.index'));

        $this->assertSoftDeleted($salesDetail);
    }
}
