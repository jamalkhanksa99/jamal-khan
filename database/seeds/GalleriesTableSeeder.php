<?php
/*
 * File name: GalleriesTableSeeder.php

 * Author: DAS360
 * Copyright (c) 2022
 */

use App\Models\Gallery;
use Illuminate\Database\Seeder;

class GalleriesTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        DB::table('galleries')->delete();
        factory(Gallery::class, 20)->create();
    }
}
