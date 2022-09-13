<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateContractsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('contracts', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('deceased_id');
            $table->unsignedBigInteger('reports_id');
            $table->unsignedBigInteger('payment_id')->nullable();
            $table->string('lessee')->nullable();
            $table->string('niche_identification_number')->nullable();
            $table->string('contract_number')->nullable();
            $table->string('address')->nullable();
            $table->string('remarks')->nullable();
            $table->foreign('deceased_id')->references('id')->on('deceased');
            $table->foreign('reports_id')->references('id')->on('reports');
            $table->foreign('payment_id')->references('id')->on('payments');
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
        Schema::dropIfExists('contracts');
    }
}
