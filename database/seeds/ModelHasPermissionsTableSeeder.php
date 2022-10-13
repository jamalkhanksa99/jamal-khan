<?php
/*
 * File name: ModelHasPermissionsTableSeeder.php

 * Author: DAS360
 * Copyright (c) 2022
 */

use Illuminate\Database\Seeder;

class ModelHasPermissionsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        DB::table('model_has_permissions')->delete();
    }
}
