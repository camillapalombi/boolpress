<?php

use Illuminate\Database\Seeder;
use App\Category;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $categories = [
            [
                'name' => 'Sport'
            ],
            [
                'name' => 'Politica'
            ],
            [
                'name' => 'Attualità'
            ],
            [
                'name' => 'Cronaca'
            ],
            [
                'name' => 'Tecnologia'
            ],
            [
                'name' => 'Estero'
            ],
            [
                'name' => 'Istruzione'
            ],
            [
                'name' => 'Cultura'
            ],
            [
                'name' => 'Economia'
            ],
            [
                'name' => 'Curiosità'
            ],
        ];

        foreach ($categories as $category) {
            Category::create($category);
        }
    }
}
