<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRetornWhatsTable extends Migration
{
    public function up()
    {
        Schema::create('retorn_whats', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->text('message')->nullable();
            $table->string('type',20)->nullable();
            $table->timestamps(7);
        });
    }
}
