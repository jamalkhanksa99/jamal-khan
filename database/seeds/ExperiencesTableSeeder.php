<?php
/*
 * File name: ExperiencesTableSeeder.php

 * Author: DAS360
 * Copyright (c) 2022
 */

use App\Models\Experience;
use Illuminate\Database\Seeder;

class ExperiencesTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        DB::table('experiences')->truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
        factory(Experience::class, 50)->create();
    }
}
