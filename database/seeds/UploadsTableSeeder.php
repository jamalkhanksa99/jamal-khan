<?php
/*
 * File name: UploadsTableSeeder.php

 * Author: DAS360
 * Copyright (c) 2022
 */

use Illuminate\Database\Seeder;

class UploadsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        DB::table('uploads')->delete();
    }
}
