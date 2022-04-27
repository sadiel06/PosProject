<?php

namespace Tests\Feature\Http\Controllers;

use App\Models\Category;
use App\Models\Producto;
use Carbon\Carbon;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use JMac\Testing\Traits\AdditionalAssertions;
use Tests\TestCase;

/**
 * @see \App\Http\Controllers\ProductoController
 */
class ProductoControllerTest extends TestCase
{
    use AdditionalAssertions, RefreshDatabase, WithFaker;

    /**
     * @test
     */
    public function index_displays_view()
    {
        $productos = Producto::factory()->count(3)->create();

        $response = $this->get(route('producto.index'));

        $response->assertOk();
        $response->assertViewIs('producto.index');
        $response->assertViewHas('productos');
    }


    /**
     * @test
     */
    public function create_displays_view()
    {
        $response = $this->get(route('producto.create'));

        $response->assertOk();
        $response->assertViewIs('producto.create');
    }


    /**
     * @test
     */
    public function store_uses_form_request_validation()
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\ProductoController::class,
            'store',
            \App\Http\Requests\ProductoStoreRequest::class
        );
    }

    /**
     * @test
     */
    public function store_saves_and_redirects()
    {
        $category = Category::factory()->create();
        $name = $this->faker->name;
        $status_id = $this->faker->numberBetween(-10000, 10000);
        $register_date = $this->faker->date();
        $price = $this->faker->randomFloat(/** double_attributes **/);
        $cost = $this->faker->word;

        $response = $this->post(route('producto.store'), [
            'category_id' => $category->id,
            'name' => $name,
            'status_id' => $status_id,
            'register_date' => $register_date,
            'price' => $price,
            'cost' => $cost,
        ]);

        $productos = Producto::query()
            ->where('category_id', $category->id)
            ->where('name', $name)
            ->where('status_id', $status_id)
            ->where('register_date', $register_date)
            ->where('price', $price)
            ->where('cost', $cost)
            ->get();
        $this->assertCount(1, $productos);
        $producto = $productos->first();

        $response->assertRedirect(route('producto.index'));
        $response->assertSessionHas('producto.id', $producto->id);
    }


    /**
     * @test
     */
    public function show_displays_view()
    {
        $producto = Producto::factory()->create();

        $response = $this->get(route('producto.show', $producto));

        $response->assertOk();
        $response->assertViewIs('producto.show');
        $response->assertViewHas('producto');
    }


    /**
     * @test
     */
    public function edit_displays_view()
    {
        $producto = Producto::factory()->create();

        $response = $this->get(route('producto.edit', $producto));

        $response->assertOk();
        $response->assertViewIs('producto.edit');
        $response->assertViewHas('producto');
    }


    /**
     * @test
     */
    public function update_uses_form_request_validation()
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\ProductoController::class,
            'update',
            \App\Http\Requests\ProductoUpdateRequest::class
        );
    }

    /**
     * @test
     */
    public function update_redirects()
    {
        $producto = Producto::factory()->create();
        $category = Category::factory()->create();
        $name = $this->faker->name;
        $status_id = $this->faker->numberBetween(-10000, 10000);
        $register_date = $this->faker->date();
        $price = $this->faker->randomFloat(/** double_attributes **/);
        $cost = $this->faker->word;

        $response = $this->put(route('producto.update', $producto), [
            'category_id' => $category->id,
            'name' => $name,
            'status_id' => $status_id,
            'register_date' => $register_date,
            'price' => $price,
            'cost' => $cost,
        ]);

        $producto->refresh();

        $response->assertRedirect(route('producto.index'));
        $response->assertSessionHas('producto.id', $producto->id);

        $this->assertEquals($category->id, $producto->category_id);
        $this->assertEquals($name, $producto->name);
        $this->assertEquals($status_id, $producto->status_id);
        $this->assertEquals(Carbon::parse($register_date), $producto->register_date);
        $this->assertEquals($price, $producto->price);
        $this->assertEquals($cost, $producto->cost);
    }


    /**
     * @test
     */
    public function destroy_deletes_and_redirects()
    {
        $producto = Producto::factory()->create();

        $response = $this->delete(route('producto.destroy', $producto));

        $response->assertRedirect(route('producto.index'));

        $this->assertDeleted($producto);
    }
}
