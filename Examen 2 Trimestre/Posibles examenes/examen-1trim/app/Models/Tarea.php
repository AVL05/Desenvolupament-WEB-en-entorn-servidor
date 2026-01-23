<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tarea extends Model
{
    use HasFactory;

    protected $table = 'tareas';

    protected $fillable = [
        'nombre',
        'descripcion',
        'fecha_finalizacion',
        'completada',
        'id_usr_crea',
        'id_usr_mod',
        'id_usr_comp',
    ];

    protected $casts = [
        'completada' => 'boolean',
        'fecha_finalizacion' => 'date',
    ];

    public function creador()
    {
        return $this->belongsTo(User::class, 'id_usr_crea');
    }

    public function modificador()
    {
        return $this->belongsTo(User::class, 'id_usr_mod');
    }

    public function completador()
    {
        return $this->belongsTo(User::class, 'id_usr_comp');
    }
}
