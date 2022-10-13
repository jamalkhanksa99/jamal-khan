<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddServiceTypeColumnsToEServicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('e_services', function (Blueprint $table) {
            $table->boolean('in_center')->after('available')->default(0);
            $table->boolean('in_home')->after('in_center')->default(0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('e_services', function (Blueprint $table) {
            $table->dropColumn('in_center');
            $table->dropColumn('in_home');
        });
    }
}
