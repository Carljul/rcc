<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePaymentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('payments', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('deceased_id');
            $table->string('payer')->nullable();
            $table->string('contact_number')->nullable();
            $table->float('amount', 8, 2)->nullable();
            $table->string('ORNumber')->nullable();
            $table->float('balance', 8, 2)->nullable();
            $table->string('terms_of_payment')->nullable();
            $table->string('remarks')->nullable();
            $table->date('datePaid')->nullable();
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
        Schema::dropIfExists('payments');
    }
}
