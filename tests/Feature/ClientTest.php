<?php

namespace Tests\Feature;

use App\Models\Client;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ClientTest extends TestCase
{
    use RefreshDatabase;

    public function test_index_lists_clients(): void
    {
        $client = Client::factory()->create(['name' => 'Ana Pérez']);

        $this->get(route('clients.index'))
            ->assertOk()
            ->assertSee($client->name)
            ->assertSee($client->email);
    }

    public function test_index_paginates_ten_per_page(): void
    {
        Client::factory()->create(['name' => 'Primero']);
        Client::factory(11)->create();

        $this->get(route('clients.index'))
            ->assertOk()
            ->assertDontSee('Primero')
            ->assertSee('?page=2', false);

        $this->get(route('clients.index', ['page' => 2]))
            ->assertOk()
            ->assertSee('Primero');
    }

    public function test_create_form_is_displayed(): void
    {
        $this->get(route('clients.create'))->assertOk()->assertSee('Nuevo cliente');
    }

    public function test_client_can_be_stored(): void
    {
        $response = $this->post(route('clients.store'), [
            'name' => 'Luis Acuña',
            'email' => 'luis@example.com',
            'phone' => '5555-1234',
            'address' => 'Ciudad de Guatemala',
        ]);

        $client = Client::where('email', 'luis@example.com')->firstOrFail();

        $response->assertRedirect(route('clients.show', $client));
        $this->assertSame('Luis Acuña', $client->name);
        $this->assertSame('5555-1234', $client->phone);
    }

    public function test_store_requires_name_and_email(): void
    {
        $this->post(route('clients.store'), [])
            ->assertSessionHasErrors(['name', 'email']);

        $this->assertDatabaseCount('clients', 0);
    }

    public function test_store_rejects_duplicate_email(): void
    {
        Client::factory()->create(['email' => 'dup@example.com']);

        $this->post(route('clients.store'), [
            'name' => 'Otro',
            'email' => 'dup@example.com',
        ])->assertSessionHasErrors('email');

        $this->assertDatabaseCount('clients', 1);
    }

    public function test_show_displays_client(): void
    {
        $client = Client::factory()->create();

        $this->get(route('clients.show', $client))
            ->assertOk()
            ->assertSee($client->name);
    }

    public function test_edit_form_is_displayed(): void
    {
        $client = Client::factory()->create();

        $this->get(route('clients.edit', $client))
            ->assertOk()
            ->assertSee($client->email);
    }

    public function test_client_can_be_updated_keeping_its_own_email(): void
    {
        $client = Client::factory()->create(['email' => 'same@example.com']);

        $this->put(route('clients.update', $client), [
            'name' => 'Nombre Nuevo',
            'email' => 'same@example.com',
        ])->assertRedirect(route('clients.show', $client));

        $this->assertSame('Nombre Nuevo', $client->fresh()->name);
    }

    public function test_update_rejects_email_used_by_another_client(): void
    {
        Client::factory()->create(['email' => 'taken@example.com']);
        $client = Client::factory()->create(['email' => 'mine@example.com']);

        $this->put(route('clients.update', $client), [
            'name' => $client->name,
            'email' => 'taken@example.com',
        ])->assertSessionHasErrors('email');

        $this->assertSame('mine@example.com', $client->fresh()->email);
    }

    public function test_destroy_soft_deletes_client(): void
    {
        $client = Client::factory()->create();

        $this->delete(route('clients.destroy', $client))
            ->assertRedirect(route('clients.index'));

        $this->assertSoftDeleted('clients', ['id' => $client->id]);
    }
}
