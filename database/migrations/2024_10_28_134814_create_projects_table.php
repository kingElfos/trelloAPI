<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProjectsTable extends Migration
{
    public function up()
    {
        Schema::create('projects', function (Blueprint $table) {
            $table->id();
            $table->string('name');                  // Nombre del proyecto
            $table->text('description')->nullable(); // Descripción opcional
            $table->timestamps();                    // created_at y updated_at
        });
    }

    public function down()
    {
        Schema::dropIfExists('projects');
    }
}
