<?php
/*
 * File name: 2021_03_25_165228_add_quantity_unit_column_e_services_table.php

 * Author: DAS360
 * Copyright (c) 2022
 */

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddQuantityUnitColumnEServicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (Schema::hasTable('e_services')) {
            Schema::table('e_services', function (Blueprint $table) {
                $table->string('quantity_unit', 127)->after('price_unit')->nullable()->default(null);
            });
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
    }
}
