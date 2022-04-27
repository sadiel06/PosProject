<?php

namespace Tests\Feature\Http\Controllers;

use App\Models\CategoryType;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use JMac\Testing\Traits\AdditionalAssertions;
use Tests\TestCase;

/**
 * @see \App\Http\Controllers\CategoryTypeController
 */
class CategoryTypeControllerTest extends TestCase
{
    use AdditionalAssertions, RefreshDatabase, WithFaker;

    /**
     * @test
     */
    public function index_displays_view()
    {
        $categoryTypes = CategoryType::factory()->count(3)->create();

        $response = $this->get(route('category-type.index'));

        $response->assertOk();
        $response->assertViewIs('categoryType.index');
        $response->assertViewHas('categoryTypes');
    }


    /**
     * @test
     */
    public function create_displays_view()
    {
        $response = $this->get(route('category-type.create'));

        $response->assertOk();
        $response->assertViewIs('categoryType.create');
    }


    /**
     * @test
     */
    public function store_uses_form_request_validation()
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\CategoryTypeController::class,
            'store',
            \App\Http\Requests\CategoryTypeStoreRequest::class
        );
    }

    /**
     * @test
     */
    public function store_saves_and_redirects()
    {
        $description = $this->faker->text;

        $response = $this->post(route('category-type.store'), [
            'description' => $description,
        ]);

        $categoryTypes = CategoryType::query()
            ->where('description', $description)
            ->get();
        $this->assertCount(1, $categoryTypes);
        $categoryType = $categoryTypes->first();

        $response->assertRedirect(route('categoryType.index'));
        $response->assertSessionHas('categoryType.id', $categoryType->id);
    }


    /**
     * @test
     */
    public function show_displays_view()
    {
        $categoryType = CategoryType::factory()->create();

        $response = $this->get(route('category-type.show', $categoryType));

        $response->assertOk();
        $response->assertViewIs('categoryType.show');
        $response->assertViewHas('categoryType');
    }


    /**
     * @test
     */
    public function edit_displays_view()
    {
        $categoryType = CategoryType::factory()->create();

        $response = $this->get(route('category-type.edit', $categoryType));

        $response->assertOk();
        $response->assertViewIs('categoryType.edit');
        $response->assertViewHas('categoryType');
    }


    /**
     * @test
     */
    public function update_uses_form_request_validation()
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\CategoryTypeController::class,
            'update',
            \App\Http\Requests\CategoryTypeUpdateRequest::class
        );
    }

    /**
     * @test
     */
    public function update_redirects()
    {
        $categoryType = CategoryType::factory()->create();
        $description = $this->faker->text;

        $response = $this->put(route('category-type.update', $categoryType), [
            'description' => $description,
        ]);

        $categoryType->refresh();

        $response->assertRedirect(route('categoryType.index'));
        $response->assertSessionHas('categoryType.id', $categoryType->id);

        $this->assertEquals($description, $categoryType->description);
    }


    /**
     * @test
     */
    public function destroy_deletes_and_redirects()
    {
        $categoryType = CategoryType::factory()->create();

        $response = $this->delete(route('category-type.destroy', $categoryType));

        $response->assertRedirect(route('categoryType.index'));

        $this->assertSoftDeleted($categoryType);
    }
}
