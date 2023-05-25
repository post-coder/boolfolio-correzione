<?php

namespace Database\Seeders;

use App\Models\Type;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use Faker\Generator as Faker;
use Illuminate\Support\Str;

class TypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {
        $types = ['Front End', 'Back End', 'Full Stack', 'Database'];

        foreach($types as $type ) {
            
            $newType = new Type();

            $newType->name = $type;
            $newType->slug = Str::slug($newType->name, '-');
            $newType->description = $faker->text();

            $newType->save();

        }
    }
}
