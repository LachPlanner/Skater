<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateModelsTable extends Migration
{
    public function up()
    {
        Schema::create('models', function (Blueprint $table) {
            $table->id();
            $table->string('model_name');
            $table->text('uri');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('models');
    }
}
