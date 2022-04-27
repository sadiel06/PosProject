<?php

namespace Tests\Feature\Http\Controllers;

use App\Models\PointOfSales;
use App\Models\Sale;
use App\Models\Status;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use JMac\Testing\Traits\AdditionalAssertions;
use Tests\TestCase;

/**
 * @see \App\Http\Controllers\SaleController
 */
class SaleControllerTest extends TestCase
{
    use AdditionalAssertions, RefreshDatabase, WithFaker;

    /**
     * @test
     */
    public function index_displays_view()
    {
        $sales = Sale::factory()->count(3)->create();

        $response = $this->get(route('sale.index'));

        $response->assertOk();
        $response->assertViewIs('sale.index');
        $response->assertViewHas('sales');
    }


    /**
     * @test
     */
    public function create_displays_view()
    {
        $response = $this->get(route('sale.create'));

        $response->assertOk();
        $response->assertViewIs('sale.create');
    }


    /**
     * @test
     */
    public function store_uses_form_request_validation()
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\SaleController::class,
            'store',
            \App\Http\Requests\SaleStoreRequest::class
        );
    }

    /**
     * @test
     */
    public function store_saves_and_redirects()
    {
        $date_created = $this->faker->date();
        $user = User::factory()->create();
        $total = $this->faker->randomFloat(/** double_attributes **/);
        $status = Status::factory()->create();
        $point_of_sales = PointOfSales::factory()->create();

        $response = $this->post(route('sale.store'), [
            'date_created' => $date_created,
            'user_id' => $user->id,
            'total' => $total,
            'status_id' => $status->id,
            'point_of_sales_id' => $point_of_sales->id,
        ]);

        $sales = Sale::query()
            ->where('date_created', $date_created)
            ->where('user_id', $user->id)
            ->where('total', $total)
            ->where('status_id', $status->id)
            ->where('point_of_sales_id', $point_of_sales->id)
            ->get();
        $this->assertCount(1, $sales);
        $sale = $sales->first();

        $response->assertRedirect(route('sale.index'));
        $response->assertSessionHas('sale.id', $sale->id);
    }


    /**
     * @test
     */
    public function show_displays_view()
    {
        $sale = Sale::factory()->create();

        $response = $this->get(route('sale.show', $sale));

        $response->assertOk();
        $response->assertViewIs('sale.show');
        $response->assertViewHas('sale');
    }


    /**
     * @test
     */
    public function edit_displays_view()
    {
        $sale = Sale::factory()->create();

        $response = $this->get(route('sale.edit', $sale));

        $response->assertOk();
        $response->assertViewIs('sale.edit');
        $response->assertViewHas('sale');
    }


    /**
     * @test
     */
    public function update_uses_form_request_validation()
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\SaleController::class,
            'update',
            \App\Http\Requests\SaleUpdateRequest::class
        );
    }

    /**
     * @test
     */
    public function update_redirects()
    {
        $sale = Sale::factory()->create();
        $date_created = $this->faker->date();
        $user = User::factory()->create();
        $total = $this->faker->randomFloat(/** double_attributes **/);
        $status = Status::factory()->create();
        $point_of_sales = PointOfSales::factory()->create();

        $response = $this->put(route('sale.update', $sale), [
            'date_created' => $date_created,
            'user_id' => $user->id,
            'total' => $total,
            'status_id' => $status->id,
            'point_of_sales_id' => $point_of_sales->id,
        ]);

        $sale->refresh();

        $response->assertRedirect(route('sale.index'));
        $response->assertSessionHas('sale.id', $sale->id);

        $this->assertEquals(Carbon::parse($date_created), $sale->date_created);
        $this->assertEquals($user->id, $sale->user_id);
        $this->assertEquals($total, $sale->total);
        $this->assertEquals($status->id, $sale->status_id);
        $this->assertEquals($point_of_sales->id, $sale->point_of_sales_id);
    }


    /**
     * @test
     */
    public function destroy_deletes_and_redirects()
    {
        $sale = Sale::factory()->create();

        $response = $this->delete(route('sale.destroy', $sale));

        $response->assertRedirect(route('sale.index'));

        $this->assertSoftDeleted($sale);
    }
}
