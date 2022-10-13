<?php
/*
 * File name: EServiceCategoriesTableSeeder.php

 * Author: DAS360
 * Copyright (c) 2022
 */

use App\Models\EServiceCategory;
use Illuminate\Database\Seeder;

class EServiceCategoriesTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {


        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        DB::table('e_service_categories')->truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        try {
            factory(EServiceCategory::class, 10)->create();
        } catch (Exception $e) {
        }
        try {
            factory(EServiceCategory::class, 10)->create();
        } catch (Exception $e) {
        }
        try {
            factory(EServiceCategory::class, 10)->create();
        } catch (Exception $e) {
        }


    }
}
