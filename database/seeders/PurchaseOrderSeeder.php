<?php

namespace Database\Seeders;

use App\Models\PurchaseOrder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PurchaseOrderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        PurchaseOrder::create([
        'expected_date_arrival' => '2023-12-07',
        'expected_time_arrival' => '14:06:00',
        'name' => 'PurchaseOrder001',
        'customer_id' => 1,
    ]);
    }
}
