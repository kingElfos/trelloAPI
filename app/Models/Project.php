<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    use HasFactory;

    // Definir los atributos que son asignables en masa
    protected $fillable = [
        'name',
        'description',
    ];

    // Relación con el modelo Task
    public function tasks()
    {
        return $this->hasMany(Task::class);
    }
}
