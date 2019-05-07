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
        $product->filename = 'php725E.tmp.jfif';
        $product->mime = 'image/jpeg';
        $product->original_filename = '1.jfif';
        $product->save();

        $product = new \App\Product();
        $product->name = 'Saturn';
        $product->category_id = 2;
        $product->filename = 'php4030.tmp.jfif';
        $product->mime = 'image/jpeg';
        $product->original_filename = '2.jfif';
        $product->save();

        $product = new \App\Product();
        $product->name = 'Starbucks';
        $product->category_id = 3;
        $product->filename = 'php5E29.tmp.jfif';
        $product->mime = 'image/jpeg';
        $product->original_filename = '3.jfif';
        $product->save();

        $product = new \App\Product();
        $product->name = 'Victoria';
        $product->category_id = 4;
        $product->filename = 'php7C80.tmp.jfif';
        $product->mime = 'image/jpeg';
        $product->original_filename = '4.jfif';
        $product->save();

        $product = new \App\Product();
        $product->name = 'BMX';
        $product->category_id = 5;
        $product->filename = 'php9A3A.tmp.jpg';
        $product->mime = 'image/jpeg';
        $product->original_filename = '5.jpg';
        $product->save();
    }
}
