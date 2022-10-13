<?php
/*
 * File name: EProvidersTableSeeder.php

 * Author: DAS360
 * Copyright (c) 2022
 */

use App\Models\EProvider;
use App\Models\EProviderUser;
use Illuminate\Database\Seeder;

class EProvidersTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {


        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        DB::table('e_providers')->truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        factory(EProvider::class, 18)->create();
        try {
            factory(EProviderUser::class, 10)->create();
        } catch (Exception $e) {
        }
        try {
            factory(EProviderUser::class, 10)->create();
        } catch (Exception $e) {
        }
        try {
            factory(EProviderUser::class, 10)->create();
        } catch (Exception $e) {
        }

    }
}
