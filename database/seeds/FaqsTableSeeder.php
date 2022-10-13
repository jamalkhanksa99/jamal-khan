<?php
/*
 * File name: FaqsTableSeeder.php

 * Author: DAS360
 * Copyright (c) 2022
 */

use App\Models\Faq;
use Illuminate\Database\Seeder;

class FaqsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {

        DB::table('faqs')->delete();
        factory(Faq::class, 30)->create();
    }
}
