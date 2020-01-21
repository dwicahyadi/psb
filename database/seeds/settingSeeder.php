<?php

use Illuminate\Database\Seeder;

class settingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Setting::insert(
            [
                'minimum_nem' => 10,
                'test_duration' => 90,
                'minimum_score' => 60,
                'school_year' => '2020/2021',
            ]
        );
    }
}
