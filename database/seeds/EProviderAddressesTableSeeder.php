<?php
/*
 * File name: EProviderAddressesTableSeeder.php

 * Author: DAS360
 * Copyright (c) 2022
 */

use App\Models\EProviderAddress;
use Illuminate\Database\Seeder;

class EProviderAddressesTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        DB::table('e_provider_addresses')->truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
        try {
            factory(EProviderAddress::class, 10)->create();
        } catch (Exception $e) {
        }
        try {
            factory(EProviderAddress::class, 10)->create();
        } catch (Exception $e) {
        }
        try {
            factory(EProviderAddress::class, 10)->create();
        } catch (Exception $e) {
        }
    }
}
