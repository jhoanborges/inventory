<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Product::create([
            'price' => 50.25,
            'name' => 'Producto 1',
            'description' => '<p>description</p>',
            'notes' => '<p>notas</p>',
            'image' => 'products/AnbmiWOSapwbR98ViyZ4McbXOv4ohC-metaQWRvYmVTdG9ja18xMzI4MDI0ODQtc2NhbGVkLTE2NDZ4ODIzLmpwZWc=-.jpg',
        ]);
    }
}
