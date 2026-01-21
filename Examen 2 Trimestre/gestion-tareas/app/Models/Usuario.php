<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Usuario extends Authenticatable
{
    protected $table = 'usuarios';
    protected $fillable = ['nombre', 'correo', 'contraseña', 'ruta_img'];

    public function tareasCreadas()
    {
        return $this->hasMany(Tarea::class, 'id_usr_crea');
    }

    public function tareasModificadas()
    {
        return $this->hasMany(Tarea::class, 'id_usr_mod');
    }

    // Sobrescribir método para usar 'contraseña' en lugar de 'password'
    public function getAuthPassword()
    {
        return $this->contraseña;
    }
}
