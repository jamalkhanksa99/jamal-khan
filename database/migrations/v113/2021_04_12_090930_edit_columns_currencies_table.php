<?php
/*
 * File name: 2021_04_12_090930_edit_columns_currencies_table.php

 * Author: DAS360
 * Copyright (c) 2022
 */

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class EditColumnsCurrenciesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (Schema::hasTable('currencies')) {
            Schema::table('currencies', function (Blueprint $table) {
                $table->longText('name')->nullable()->change();
                $table->longText('symbol')->nullable()->change();
                $table->longText('code')->nullable()->change();
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
