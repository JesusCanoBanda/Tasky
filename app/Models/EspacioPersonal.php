<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EspacioPersonal extends Model
{
    use HasFactory;

    // Definir el nombre de la tabla
    protected $table = 'espacio_personal';

    // Definir los campos que pueden ser asignados masivamente
    protected $fillable = ['nombre', 'categoria', 'id_user'];

    // Relación de pertenencia con el modelo User
    public function user()
    {
        return $this->belongsTo(User::class, 'id_user'); // Cambiar 'user_id' por 'id_user'
    }
}
