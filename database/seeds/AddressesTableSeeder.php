<?php
/*
 * File name: AddressesTableSeeder.php

 * Author: DAS360
 * Copyright (c) 2022
 */

use App\Models\Address;
use Illuminate\Database\Seeder;

class AddressesTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {

        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        DB::table('addresses')->truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        factory(Address::class, 20)->create();

    }
}
