<?php
/*
 * File name: OptionsTableSeeder.php

 * Author: DAS360
 * Copyright (c) 2022
 */

use App\Models\Option;
use Illuminate\Database\Seeder;

class OptionsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        DB::table('options')->delete();
        factory(Option::class, 100)->create();
    }
}
