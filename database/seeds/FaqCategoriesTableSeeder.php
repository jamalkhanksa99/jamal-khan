<?php
/*
 * File name: FaqCategoriesTableSeeder.php

 * Author: DAS360
 * Copyright (c) 2022
 */

use App\Models\FaqCategory;
use Illuminate\Database\Seeder;

class FaqCategoriesTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        DB::table('faq_categories')->delete();
        factory(FaqCategory::class, 5)->create();
    }
}
