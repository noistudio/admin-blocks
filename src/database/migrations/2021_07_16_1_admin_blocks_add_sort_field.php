<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AdminBlocksAddSortField extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        Schema::table(config("admin_blocks.tables.blocks"), function (Blueprint $table) {
            
            $table->integer("sort")->nullable(true);

        });


    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table(config("admin_blocks.tables.blocks"), function (Blueprint $table) {
            $table->dropColumn("sort");

        });
    }
}
