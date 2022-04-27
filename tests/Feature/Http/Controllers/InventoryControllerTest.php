<?php

namespace Tests\Feature\Http\Controllers;

use App\Models\Inventory;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use JMac\Testing\Traits\AdditionalAssertions;
use Tests\TestCase;

/**
 * @see \App\Http\Controllers\InventoryController
 */
class InventoryControllerTest extends TestCase
{
    use AdditionalAssertions, RefreshDatabase, WithFaker;

    /**
     * @test
     */
    public function index_displays_view()
    {
        $inventories = Inventory::factory()->count(3)->create();

        $response = $this->get(route('inventory.index'));

        $response->assertOk();
        $response->assertViewIs('inventory.index');
        $response->assertViewHas('inventories');
    }


    /**
     * @test
     */
    public function create_displays_view()
    {
        $response = $this->get(route('inventory.create'));

        $response->assertOk();
        $response->assertViewIs('inventory.create');
    }


    /**
     * @test
     */
    public function store_uses_form_request_validation()
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\InventoryController::class,
            'store',
            \App\Http\Requests\InventoryStoreRequest::class
        );
    }

    /**
     * @test
     */
    public function store_saves_and_redirects()
    {
        $date = $this->faker->date();
        $user = User::factory()->create();
        $note = $this->faker->text;

        $response = $this->post(route('inventory.store'), [
            'date' => $date,
            'user_id' => $user->id,
            'note' => $note,
        ]);

        $inventories = Inventory::query()
            ->where('date', $date)
            ->where('user_id', $user->id)
            ->where('note', $note)
            ->get();
        $this->assertCount(1, $inventories);
        $inventory = $inventories->first();

        $response->assertRedirect(route('inventory.index'));
        $response->assertSessionHas('inventory.id', $inventory->id);
    }


    /**
     * @test
     */
    public function show_displays_view()
    {
        $inventory = Inventory::factory()->create();

        $response = $this->get(route('inventory.show', $inventory));

        $response->assertOk();
        $response->assertViewIs('inventory.show');
        $response->assertViewHas('inventory');
    }


    /**
     * @test
     */
    public function edit_displays_view()
    {
        $inventory = Inventory::factory()->create();

        $response = $this->get(route('inventory.edit', $inventory));

        $response->assertOk();
        $response->assertViewIs('inventory.edit');
        $response->assertViewHas('inventory');
    }


    /**
     * @test
     */
    public function update_uses_form_request_validation()
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\InventoryController::class,
            'update',
            \App\Http\Requests\InventoryUpdateRequest::class
        );
    }

    /**
     * @test
     */
    public function update_redirects()
    {
        $inventory = Inventory::factory()->create();
        $date = $this->faker->date();
        $user = User::factory()->create();
        $note = $this->faker->text;

        $response = $this->put(route('inventory.update', $inventory), [
            'date' => $date,
            'user_id' => $user->id,
            'note' => $note,
        ]);

        $inventory->refresh();

        $response->assertRedirect(route('inventory.index'));
        $response->assertSessionHas('inventory.id', $inventory->id);

        $this->assertEquals(Carbon::parse($date), $inventory->date);
        $this->assertEquals($user->id, $inventory->user_id);
        $this->assertEquals($note, $inventory->note);
    }


    /**
     * @test
     */
    public function destroy_deletes_and_redirects()
    {
        $inventory = Inventory::factory()->create();

        $response = $this->delete(route('inventory.destroy', $inventory));

        $response->assertRedirect(route('inventory.index'));

        $this->assertDeleted($inventory);
    }
}
