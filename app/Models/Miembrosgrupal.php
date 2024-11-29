<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MiembrosGrupal extends Model
{
    use HasFactory;

    /**
     * La tabla asociada al modelo.
     *
     * @var string
     */
    protected $table = 'miembros_grupal';

    /**
     * Los atributos que son asignables en masa.
     *
     * @var array
     */
    protected $fillable = [
        'rol',
        'id_usuario',
        'id_grupal',
    ];

    /**
     * Relación con el modelo User.
     * Un miembro grupal está asociado a un usuario.
     */
    public function usuario()
    {
        return $this->belongsTo(User::class, 'id_usuario');
    }

    /**
     * Relación con el modelo EspacioGrupal.
     * Un miembro grupal pertenece a un espacio grupal.
     */
    public function grupal()
    {
        return $this->belongsTo(EspacioGrupal::class, 'id_grupal');
    }
}
