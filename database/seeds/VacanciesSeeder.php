<?php

use Faker\Factory;
use Illuminate\Database\Seeder;
use \Illuminate\Support\Facades\DB;

class VacanciesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Factory::create('ru_RU');
        for ($i = 0; $i < 4; $i++) {
            DB::table('vacancies')->insert([
                'name' => $faker->word,
                'description' => $faker->text(),
                'company_id' => rand(1,2),
            ]);
        }
    }
}
