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
        Product::create([
            "name" => "Labtop ",
            "desc" => "desc labtop 2020",
            "price" => 2000,
            "quantity" => 5,
            "image" => "Products/product_02.jpg"
        ]);

            Product::create([
            "name" => "Samsung ",
            "desc" => "desc labtop 2020",
            "price" => 15000,
            "quantity" => 4,
            "image" => "Products/product_03.jpg"

        ]);


            Product::create([
            "name" => "Iphone ",
            "desc" => "desc Iphone 2020",
            "price" => 16000,
            "quantity" => 6,
            "image" => "Products/product_04.jpg"

        ]);
    }
}
