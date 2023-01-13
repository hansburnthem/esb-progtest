<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('addresses', function (Blueprint $table) {
            $table->id();
            $table->string('company');
            $table->string('address');
            $table->timestamps();
        });

        Schema::table('invoices', function (Blueprint $table) {
            $table->unsignedBigInteger('from');
            $table->foreign('from')->references('id')->on('addresses');
            $table->unsignedBigInteger('for');
            $table->foreign('for')->references('id')->on('addresses');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('addresses');
    }
};
