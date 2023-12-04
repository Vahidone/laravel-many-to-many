<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Generator as Faker;
use App\Models\Type;
use App\Functions\Helper;

class TypeTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)

    {
        for($i = 0; $i < 10; $i++) {
            $new_type = new Type();
            $new_type->title = $faker->sentence(3);
            $new_type->slug = Helper::generateSlug( $new_type->title, Type::class);
            $new_type->save();
        }
    }
}
