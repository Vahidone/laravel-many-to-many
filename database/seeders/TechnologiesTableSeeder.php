<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Technology;
use App\Functions\Helper;

class TechnologiesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = ['HTML', 'CSS', 'BOOTSTRAP', 'JAVASCRIPT', 'VUE', 'PHP', 'MYSQL','LARAVEL'];
        foreach ($data as $technology) {
            $new_technology = new Technology();
            $new_technology->name = $technology;
            $new_technology->slug = Helper::generateSlug($technology, Technology::class);
            $new_technology->save();
        }

    }
}
