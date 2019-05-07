<?php

use Illuminate\Database\Seeder;

class CategoryTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $categories = [
            'Notebook',
            'Teapot',
            'Cups',
            'Swimwear',
            'Bicycles',
        ];

        foreach ($categories as $category) {
            \App\Category::create(['name' => $category,'user_id' => 2]);
        }
    }
}
