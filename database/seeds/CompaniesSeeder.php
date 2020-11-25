<?php
use Faker\Factory;
use Illuminate\Database\Seeder;
use \Illuminate\Support\Facades\DB;

class CompaniesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Factory::create('ru_RU');
        for ($i = 0; $i < 2; $i++) {
            DB::table('companies')->insert([
                'name' => $faker->company,
            ]);
        }
    }
}
