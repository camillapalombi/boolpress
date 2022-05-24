<?php

use Illuminate\Database\Seeder;
use App\Tag;

class TagSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $tags = ['cani', 'gatti', 'Roma', 'Elon Musk', 'Bitcoin', 'Carbonara', 'funghi', 'php', 'oop', 'javascript', 'Italia'];

        foreach ($tags as $tag) {
            Tag::create([
                'name'  => $tag,
                'slug'  => Str::slug($tag)
            ]);
        }
    }
}
