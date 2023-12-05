<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Generator as Faker;
use App\Models\Type;
use App\Models\Project;
use App\Functions\Helper;

class ProjectsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {
        for($i = 0; $i < 30; $i++){
            $new_project = new Project();
            // associo randomicamente una type al project con il seguente metodo
            $new_project->type_id = Type::inRandomOrder()->first()->id;

            $new_project->title = $faker->sentence();
            $new_project->slug = Helper::generateSlug($new_project->title, Project::class);
            $new_project->description = $faker->paragraph();
            $new_project->release_date = $faker->date();
            $new_project->save();
        }
    }
}
