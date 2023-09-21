<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateWhatsTable extends Migration
{
    public function up()
    {
        Schema::create('whats', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->text('message')->nullable();
            $table->string('type',20)->nullable();
            $table->timestamps(7);
        });
    }
}
