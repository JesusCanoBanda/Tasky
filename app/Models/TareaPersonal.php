<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TareaPersonal extends Model
{
    use HasFactory;
    protected $fillable = [
        "nombre",
        'fecha_inicio',
        'fecha_final',
        'descripcion',
        'estado',
        'porcentaje',
        'nombre_campo',
    ];

    public function espacioPersonal(){
        return $this->belongsTo(espacioPersonal::class,'id_espacio');
    }
}
