<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;

    // Definir los atributos que son asignables en masa
    protected $fillable = [
        'title',
        'description',
        'completed',
        'project_id',
    ];

    // Relación con el modelo Project
    public function project()
    {
        return $this->belongsTo(Project::class);
    }
}
