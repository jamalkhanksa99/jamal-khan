<?php
/*
 * File name: 2021_01_15_115850_create_e_provider_taxes_table.php

 * Author: DAS360
 * Copyright (c) 2022
 */

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateEProviderTaxesTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('e_provider_taxes', function (Blueprint $table) {
            $table->integer('e_provider_id')->unsigned();
            $table->integer('tax_id')->unsigned();
            $table->primary(['e_provider_id', 'tax_id']);
            $table->foreign('e_provider_id')->references('id')->on('e_providers')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('tax_id')->references('id')->on('taxes')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('e_provider_taxes');
    }
}
