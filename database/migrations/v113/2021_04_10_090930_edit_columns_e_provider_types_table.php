<?php
/*
 * File name: 2021_04_10_090930_edit_columns_e_provider_types_table.php

 * Author: DAS360
 * Copyright (c) 2022
 */

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class EditColumnsEProviderTypesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (Schema::hasTable('e_provider_types')) {
            Schema::table('e_provider_types', function (Blueprint $table) {
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
