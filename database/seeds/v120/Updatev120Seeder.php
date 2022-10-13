<?php
/*
 * File name: Updatev120Seeder.php

 * Author: DAS360
 * Copyright (c) 2022
 */

use Illuminate\Database\Seeder;

class Updatev120Seeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(PaymentMethodsTableV120Seeder::class);
        $this->call(AppSettingsTableV120Seeder::class);
    }
}
