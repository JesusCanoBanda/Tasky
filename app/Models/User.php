<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * Tabla asociada al modelo.
     *
     * @var string
     */
    protected $table = 'users';

    /**
     * Atributos asignables en masa.
     *
     * @var array<int, string>
     */
    protected $fillable = ['name', 'user_name', 'apellidos', 'email', 'password', 'fecha_registro', 'rol'];

    /**
     * Atributos que deben estar ocultos en la serialización.
     *
     * @var array<int, string>
     */
    protected $hidden = ['password', 'remember_token'];

    /**
     * Los atributos que deben ser casteados.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    /**
     * Relación con EspacioPersonal.
     * Un usuario puede tener múltiples espacios personales.
     */
    public function espacioPersonal()
    {
        return $this->hasMany(EspacioPersonal::class, 'id_user');
    }

    /**
     * Relación con Miembrogrupal.
     * Un usuario puede ser parte de múltiples espacios grupales como miembro.
     */
    public function Miembrogrupal()
    {
        return $this->hasMany(Miembrogrupal::class, 'id_usuario');
    }

    /**
     * Relación con EspacioGrupal a través de Miembrogrupal.
     * Un usuario puede pertenecer a múltiples espacios grupales.
     */
    public function espaciosGrupales()
    {
        return $this->hasManyThrough(
            EspacioGrupal::class,
            Miembrogrupal::class,
            'id_usuario', // Clave foránea en Miembrogrupal
            'id', // Clave foránea en EspacioGrupal (debería ser 'id_grupal' en lugar de 'id')
            'id', // Clave local en User
            'id_grupal', // Clave local en Miembrogrupal
        );
    }

    public function isAdmin()
    {
        return $this->rol === 1;
    }
}
