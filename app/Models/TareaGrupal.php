<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TareaGrupal extends Model
{
    use HasFactory;

    /**
     * La tabla asociada al modelo.
     *
     * @var string
     */
    protected $table = 'tarea_grupal';

    /**
     * Los atributos que son asignables en masa.
     *
     * @var array
     */
    protected $fillable = [
        'nombre',
        'fechainicio',
        'fechafinal',
        'descripcion',
        'estado',
        'porcentaje',
        'categoria',
        'id_espacio',
        'responsable',
    ];

    /**
     * Relación con EspacioGrupal.
     * Una tarea grupal pertenece a un espacio grupal.
     */
    public function espacio()
    {
        return $this->belongsTo(EspacioGrupal::class, 'id_espacio');
    }
}
