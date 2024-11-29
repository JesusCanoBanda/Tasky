<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TareaPersonal extends Model
{
    use HasFactory;

    protected $table = 'tarea_personal';
    protected $fillable = [
        "nombre",
        'fecha_inicio',
        'fecha_final',
        'descripcion',
        'estado',
        'porcentaje',
        'nombre_campo',
        'id_espacio'
    ];

    public function espacioPersonal()
    {
        return $this->belongsTo(EspacioPersonal::class, 'id_espacio');
    }

}
