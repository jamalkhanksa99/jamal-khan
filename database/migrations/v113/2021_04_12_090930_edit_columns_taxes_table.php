<?php
/*
 * File name: 2021_04_12_090930_edit_columns_taxes_table.php

 * Author: DAS360
 * Copyright (c) 2022
 */

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class EditColumnsTaxesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (Schema::hasTable('taxes')) {
            Schema::table('taxes', function (Blueprint $table) {
                $table->longText('name')->nullable()->change();
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
