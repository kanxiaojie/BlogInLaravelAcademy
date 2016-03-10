<?php

use App\Tag;
use Illuminate\Database\Seeder;

class TagTableSeeder extends Seeder{

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // TODO: Implement run() method.
        Tag::truncate();

        factory(Tag::class, 5)->create();
    }
}