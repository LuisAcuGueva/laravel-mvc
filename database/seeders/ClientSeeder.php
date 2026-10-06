<?php

namespace Database\Seeders;

use App\Models\Client;
use Illuminate\Database\Seeder;

class ClientSeeder extends Seeder
{
    /**
     * Seed the clients table with sample data.
     */
    public function run(): void
    {
        Client::factory(10)->create();
    }
}
