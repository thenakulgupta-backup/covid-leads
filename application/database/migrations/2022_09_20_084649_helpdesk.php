<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Helpdesk extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('Helpdesk', function (Blueprint $table) {
            $table->id();
            $table->text('organisation_name')->nullable();
            $table->text('phone')->nullable();
            $table->text('organisation_type')->nullable();
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
        Schema::dropIfExists('Helpdesk');
    }
}
