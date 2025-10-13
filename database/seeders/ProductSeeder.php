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
        //
        Product::insert([
            [
                'name' => 'TUF Gaming',
                'description' => 'null',
                'price' => 1200,
                'stock' => 10,
                'category_id' => 1,
                'image' => 'iphone15.jpg',
            ],
            [
                'name' => 'Dell',
                'description' => 'null',
                'price' => 2500,
                'stock' => 50,
                'category_id' => 2,
                'image' => 'tshirt.jpg',
            ],
        ]);
    }
}
