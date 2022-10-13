<?php
/*
 * File name: BookingsTableSeeder.php

 * Author: DAS360
 * Copyright (c) 2022
 */

use Illuminate\Database\Seeder;

class BookingsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        DB::table('bookings')->delete();
    }
}
