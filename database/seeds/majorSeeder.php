<?php

use Illuminate\Database\Seeder;

class majorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $majors = [
            ['code'=>'OTM','major_name'=> 'Otomotif', 'description'=>'Neque porro quisquam est qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit.'],
            ['code'=>'AKN','major_name'=> 'Akuntansi', 'description'=>'Neque porro quisquam est qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit.'],
        ];

        \App\Major::insert($majors);
    }
}
