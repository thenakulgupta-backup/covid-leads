<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class TeleConsultation extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('TeleConsultation', function (Blueprint $table) {
            $table->id();
            $table->text('doctor_name')->nullable();
            $table->text('phone')->nullable();
            $table->text('type')->nullable();
            $table->text('state')->nullable();
            $table->text('location')->nullable();
            $table->text('remarks')->nullable();
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
        Schema::dropIfExists('TeleConsultation');
    }
}
