<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRccDefaultsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rcc_defaults', function (Blueprint $table) {
            $table->id();
            $table->string('cemetery_administrator')->nullable();
            $table->string('parish_office_staff')->nullable();
            $table->string('parish_team_moderator')->nullable();
            $table->string('parish_team_member')->nullable();
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
        Schema::dropIfExists('rcc_defaults');
    }
}
