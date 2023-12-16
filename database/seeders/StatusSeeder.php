<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Status;

class StatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Status::create([
            'name' => 'Receptions',
            'order' => 1,
        ]);

        Status::create([
            'name' => 'Internal Transit',
            'order' => 2,
        ]);

        Status::create([
            'name' => 'Picking',
            'order' => 3,
        ]);

        Status::create([
            'name' => 'Delivery Orders',
            'order' => 4,
        ]);
    }
}
