<?php

namespace Database\Seeders;

use App\Models\Project;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use Faker\Generator as Faker;
use Illuminate\Support\Str;

class ProjectSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {
        for($i = 0; $i < 10; $i++ ) {

            $newProject = new Project();

            $newProject->title = $faker->sentence(6);
            $newProject->slug = Str::slug($newProject->title, '-');
            $newProject->description = $faker->text();
            $newProject->repo = $faker->url();
            
            $newProject->type_id = rand(1,4);

            $newProject->save();

        }
    }
}
