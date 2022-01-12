<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateQualificationResultsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('qualification_results', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('registration_id')->nullable();
            $table->foreign('registration_id')->references('id')->on('registrations')->onDelete('cascade');
            $table->integer('points');
            $table->string('status');
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
        Schema::dropIfExists('qualification_results');
    }
}
