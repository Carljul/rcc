<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDeceasedTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('deceased', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('person_id');
            $table->unsignedBigInteger('relative_id')->nullable();
            $table->unsignedBigInteger('payment_id')->nullable();
            $table->date('dateDied')->nullable();
            $table->date('internmentDate')->nullable();
            $table->string('internmentTime')->nullable();
            $table->date('expiryDate')->nullable();
            $table->string('causeOfDeath')->nullable();
            $table->string('location')->nullable();
            $table->foreign('person_id')->references('id')->on('person');
            $table->foreign('relative_id')->references('id')->on('relative');
            $table->foreign('payment_id')->references('id')->on('payments');
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
        Schema::dropIfExists('deceased');
    }
}
