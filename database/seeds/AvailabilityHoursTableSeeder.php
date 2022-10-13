<?php
/*
 * File name: AvailabilityHoursTableSeeder.php

 * Author: DAS360
 * Copyright (c) 2022
 */

use App\Models\AvailabilityHour;
use Illuminate\Database\Seeder;

class AvailabilityHoursTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        DB::table('availability_hours')->truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        factory(AvailabilityHour::class, 50)->create();
    }
}
