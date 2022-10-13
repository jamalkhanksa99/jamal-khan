<?php
/*
 * File name: PaymentsTableSeeder.php

 * Author: DAS360
 * Copyright (c) 2022
 */

use Illuminate\Database\Seeder;

class PaymentsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        DB::table('payments')->delete();
    }
}
