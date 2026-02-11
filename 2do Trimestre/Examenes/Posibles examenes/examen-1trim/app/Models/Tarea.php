<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tarea extends Model
{
    use HasFactory;

    // Especificamos la tabla asociada al modelo
    protected $table = 'tareas';

    // Definimos los campos que se pueden asignar masivamente (Mass Assignment)
    protected $fillable = [
        'nombre',
        'descripcion',
        'fecha_finalizacion',
        'completada',
        'id_usr_crea',
        'id_usr_mod',
        'id_usr_comp',
    ];

    // Casteamos atributos automáticamente a tipos nativos
    protected $casts = [
        'completada' => 'boolean',
        'fecha_finalizacion' => 'date',
    ];

    // Relación: Una tarea es creada por un usuario
    public function creador()
    {
        return $this->belongsTo(User::class, 'id_usr_crea');
    }

    // Relación: Una tarea es modificada por un usuario
    public function modificador()
    {
        return $this->belongsTo(User::class, 'id_usr_mod');
    }

    // Relación: Una tarea es completada por un usuario
    public function completador()
    {
        return $this->belongsTo(User::class, 'id_usr_comp');
    }
}
