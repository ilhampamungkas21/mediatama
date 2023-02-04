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
        Schema::create('model_customer_requests', function (Blueprint $table) {
            $table->id();
            $table->integer('id_user');
            $table->integer('id_video');
            $table->string('status')->default('menunggu-konfirmasi');
            $table->dateTime('acces_start')->nullable();
            $table->dateTime('acces_end')->nullable();
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
        Schema::dropIfExists('model_customer_requests');
    }
};
