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
            $table->date('dateDied')->nullable();
            $table->date('internmentDate')->nullable();
            $table->string('internmentTime')->nullable();
            $table->date('expiryDate')->nullable();
            $table->string('causeOfDeath')->nullable();
            $table->string('location')->nullable();
            $table->string('vicinity')->nullable();
            $table->string('area')->nullable();
            $table->string('remarks', 1000)->nullable();
            $table->boolean('isApprove')->default(0);
            $table->integer('approvedBy')->nullable();
            $table->integer('createdBy')->nullable();
            $table->integer('updatedBy')->nullable();
            $table->integer('deletedBy')->nullable();
            $table->foreign('person_id')->references('id')->on('person');
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
