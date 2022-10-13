<?php
/*
 * File name: AppSettingsTableV123Seeder.php

 * Author: DAS360
 * Copyright (c) 2022
 */

use Illuminate\Database\Seeder;

class AppSettingsTableV123Seeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        DB::table('app_settings')->insert(array(
            array(
                'key' => 'enable_paymongo',
                'value' => '1',
            ),
            array(
                'key' => 'paymongo_key',
                'value' => 'pk_test_iD6aYYm4yFuvkuisyU2PGSYH',
            ),
            array(
                'key' => 'paymongo_secret',
                'value' => 'sk_test_oxD79bMKxb8sA47ZNyYPXwf3',
            ),
        ));


    }
}
