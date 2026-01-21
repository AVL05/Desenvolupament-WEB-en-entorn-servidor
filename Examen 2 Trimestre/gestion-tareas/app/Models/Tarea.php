<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tarea extends Model
{
    protected $fillable = [
        'nombre',
        'descripcion',
        'completada',
        'id_usr_crea',
        'id_usr_mod',
        'id_usr_comp'
    ];

    protected $casts = [
        'completada' => 'boolean',
        'fecha_creacion' => 'datetime',
    ];

    public function usuarioCreador()
    {
        return $this->belongsTo(Usuario::class, 'id_usr_crea');
    }

    public function usuarioModificador()
    {
        return $this->belongsTo(Usuario::class, 'id_usr_mod');
    }

    public function usuarioCompletador()
    {
        return $this->belongsTo(Usuario::class, 'id_usr_comp');
    }
}
