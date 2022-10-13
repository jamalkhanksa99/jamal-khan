<?php
/*
 * File name: 2021_10_22_090930_edit_columns_wallets_table.php

 * Author: DAS360
 * Copyright (c) 2022
 */

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class EditColumnsWalletsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (Schema::hasTable('wallets')) {
            Schema::table('wallets', function (Blueprint $table) {
                $table->longText('currency')->nullable()->change();
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
