<?php
/*
 * File name: EServicesTableSeeder.php

 * Author: DAS360
 * Copyright (c) 2022
 */

use App\Models\EService;
use Illuminate\Database\Seeder;

class EServicesTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        DB::table('e_services')->delete();
        factory(EService::class, 40)->create();
    }
}
