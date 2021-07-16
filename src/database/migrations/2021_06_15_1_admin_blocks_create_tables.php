<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AdminBlocksCreateTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
         
        Schema::create(config("admin_blocks.tables.blocks"), function (Blueprint $table) {
            $table->id();

            $table->string('title');
            $table->json("data");
            $table->boolean("enable")->default(true);
            $table->integer("position_id");
            $table->string("type",200);
            $table->string("language","20")->default("ALL");
            $table->timestamps();
        });

        Schema::create(config("admin_blocks.tables.positions"), function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists(config("admin_blocks.tables.blocks"));
        Schema::dropIfExists(config("admin_blocks.tables.positions"));
    }
}
