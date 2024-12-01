<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EspacioGrupal extends Model
{
    use HasFactory;

    /**
     * La tabla asociada al modelo.
     *
     * @var string
     */
    protected $table = 'espacio_grupal';

    /**
     * Los atributos que son asignables en masa.
     *
     * @var array
     */
    protected $fillable = ['nombre', 'codigo', 'categoria'];

    /**
     * Relación con TareaGrupal.
     * Un espacio grupal puede tener múltiples tareas grupales.
     */
    public function tareas()
    {
        return $this->hasMany(TareaGrupal::class, 'id_espacio');
    }
    // Modelo EspacioGrupal
    public function miembros()
    {
        return $this->hasMany(Miembrogrupal::class, 'id_grupal');
    }
}
