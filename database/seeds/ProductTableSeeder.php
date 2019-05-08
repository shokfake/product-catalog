<?php

use Illuminate\Database\Seeder;

class ProductTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $product = new \App\Product();
        $product->name = 'Asus';
        $product->category_id = 1;
        $product->image = '1.jpg';
        $product->save();

        $product = new \App\Product();
        $product->name = 'Saturn';
        $product->category_id = 2;
        $product->image = '2.jpg';
        $product->save();

        $product = new \App\Product();
        $product->name = 'Starbucks';
        $product->category_id = 3;
        $product->image = '3.jpg';
        $product->save();

        $product = new \App\Product();
        $product->name = 'Victoria';
        $product->category_id = 4;
        $product->image = '4.jpg';
        $product->save();

        $product = new \App\Product();
        $product->name = 'BMX';
        $product->category_id = 5;
        $product->image = '5.jpg';
        $product->save();
    }
}
