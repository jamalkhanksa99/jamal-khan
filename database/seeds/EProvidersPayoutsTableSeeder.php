<?php
/*
 * File name: EProvidersPayoutsTableSeeder.php

 * Author: DAS360
 * Copyright (c) 2022
 */

use Illuminate\Database\Seeder;

class EProvidersPayoutsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        DB::table('e_provider_payouts')->delete();
    }
}
