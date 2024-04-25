<?php

namespace Database\Seeders;

use App\Models\Callout;
use Illuminate\Database\Seeder;

class CalloutSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Callout::factory(100)->create();
    }
}
