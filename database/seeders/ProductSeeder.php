<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Product;
use Illuminate\Support\Carbon;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $now = Carbon::now();

        Product::insert([
            [
                'name'       => 'Laptop',
                'sku'        => 'SKU001',
                'price'      => 75000,
                'quantity'   => 10,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'name'       => 'Keyboard',
                'sku'        => 'SKU002',
                'price'      => 1500,
                'quantity'   => 25,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'name'       => 'Monitor',
                'sku'        => 'SKU003',
                'price'      => 12000,
                'quantity'   => 8,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'name'       => 'Mouse',
                'sku'        => 'SKU004',
                'price'      => 500,
                'quantity'   => 40,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'name'       => 'USB Cable',
                'sku'        => 'SKU005',
                'price'      => 150,
                'quantity'   => 60,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'name'       => 'Printer',
                'sku'        => 'SKU006',
                'price'      => 15000,
                'quantity'   => 15,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'name'       => 'SSD 256GB',
                'sku'        => 'SKU007',
                'price'      => 2500,
                'quantity'   => 20,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'name'       => 'HDD 1TB',
                'sku'        => 'SKU008',
                'price'      => 5000,
                'quantity'   => 30,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'name'       => 'Webcam',
                'sku'        => 'SKU009',
                'price'      => 2500,
                'quantity'   => 10,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'name'       => 'HDMI Cable',
                'sku'        => 'SKU010',
                'price'      => 300,
                'quantity'   => 9,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'name'       => 'Projector',
                'sku'        => 'SKU011',
                'price'      => 43000,
                'quantity'   => 3,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'name'       => 'Graphics Card',
                'sku'        => 'SKU012',
                'price'      => 30000,
                'quantity'   => 7,
                'created_at' => $now,
                'updated_at' => $now,
            ]
        ]);
    }
}
