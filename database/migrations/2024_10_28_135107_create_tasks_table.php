<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTasksTable extends Migration
{
    public function up()
    {
        Schema::create('tasks', function (Blueprint $table) {
            $table->id();
            $table->string('title');                                             // Título de la tarea
            $table->text('description')->nullable();                             // Descripción opcional
            $table->foreignId('project_id')->constrained()->onDelete('cascade'); // Relación con proyectos
            $table->boolean('completed')->default(false);                        // Estado de la tarea
            $table->timestamps();                                                // created_at y updated_at
        });
    }

    public function down()
    {
        Schema::dropIfExists('tasks');
    }
}
