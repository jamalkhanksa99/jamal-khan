<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddTaxNumberColumnToEProvidersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('e_providers', function (Blueprint $table) {
            $table->string('tax_number', 50)->nullable()->after('availability_range');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('e_providers', function (Blueprint $table) {
            $table->dropColumn('tax_number');
        });
    }
}
