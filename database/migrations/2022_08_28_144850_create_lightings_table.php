<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLightingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('lightings', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('deceased_id');
            $table->string('name');
            $table->date('dateOfConnection');
            $table->date('expiryDate');
            $table->float('amount', 8, 2);
            $table->string('ORNumber')->nullable();
            $table->foreign('deceased_id')->references('id')->on('deceased');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('lightings');
    }
}
