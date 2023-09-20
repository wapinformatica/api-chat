<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePersonalTokensTable extends Migration
{
    public function up()
    {
        Schema::create('personal_tokens', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->foreignId('user_id')->constrained()->nullable();
            $table->string('token')->nullable();
            $table->boolean('status')->default(1);
            $table->timestamps();
        });
    }
}
