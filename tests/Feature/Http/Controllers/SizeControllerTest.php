<?php

namespace Tests\Feature\Http\Controllers;

use App\Models\Size;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use JMac\Testing\Traits\AdditionalAssertions;
use Tests\TestCase;

/**
 * @see \App\Http\Controllers\SizeController
 */
class SizeControllerTest extends TestCase
{
    use AdditionalAssertions, RefreshDatabase, WithFaker;

    /**
     * @test
     */
    public function index_displays_view()
    {
        $sizes = Size::factory()->count(3)->create();

        $response = $this->get(route('size.index'));

        $response->assertOk();
        $response->assertViewIs('size.index');
        $response->assertViewHas('sizes');
    }


    /**
     * @test
     */
    public function create_displays_view()
    {
        $response = $this->get(route('size.create'));

        $response->assertOk();
        $response->assertViewIs('size.create');
    }


    /**
     * @test
     */
    public function store_uses_form_request_validation()
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\SizeController::class,
            'store',
            \App\Http\Requests\SizeStoreRequest::class
        );
    }

    /**
     * @test
     */
    public function store_saves_and_redirects()
    {
        $description = $this->faker->text;

        $response = $this->post(route('size.store'), [
            'description' => $description,
        ]);

        $sizes = Size::query()
            ->where('description', $description)
            ->get();
        $this->assertCount(1, $sizes);
        $size = $sizes->first();

        $response->assertRedirect(route('size.index'));
        $response->assertSessionHas('size.id', $size->id);
    }


    /**
     * @test
     */
    public function show_displays_view()
    {
        $size = Size::factory()->create();

        $response = $this->get(route('size.show', $size));

        $response->assertOk();
        $response->assertViewIs('size.show');
        $response->assertViewHas('size');
    }


    /**
     * @test
     */
    public function edit_displays_view()
    {
        $size = Size::factory()->create();

        $response = $this->get(route('size.edit', $size));

        $response->assertOk();
        $response->assertViewIs('size.edit');
        $response->assertViewHas('size');
    }


    /**
     * @test
     */
    public function update_uses_form_request_validation()
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\SizeController::class,
            'update',
            \App\Http\Requests\SizeUpdateRequest::class
        );
    }

    /**
     * @test
     */
    public function update_redirects()
    {
        $size = Size::factory()->create();
        $description = $this->faker->text;

        $response = $this->put(route('size.update', $size), [
            'description' => $description,
        ]);

        $size->refresh();

        $response->assertRedirect(route('size.index'));
        $response->assertSessionHas('size.id', $size->id);

        $this->assertEquals($description, $size->description);
    }


    /**
     * @test
     */
    public function destroy_deletes_and_redirects()
    {
        $size = Size::factory()->create();

        $response = $this->delete(route('size.destroy', $size));

        $response->assertRedirect(route('size.index'));

        $this->assertSoftDeleted($size);
    }
}
