<?php
/*
 * File name: Updatev126Seeder.php

 * Author: DAS360
 * Copyright (c) 2022
 */

use Illuminate\Database\Seeder;

class Updatev126Seeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        DB::table('app_settings')->insert(array(
            array(
                'key' => 'default_country_code',
                'value' => 'DE',
            ),
        ));
    }
}
