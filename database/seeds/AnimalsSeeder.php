<?php

use Illuminate\Database\Seeder;

class AnimalsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('animals')->insert([
            'name' => 'Khác',
            'avatar' => '123.img',
            'description' => 'Đây là ảnh khác',
        ]);
    }
}
