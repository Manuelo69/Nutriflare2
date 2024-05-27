<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\DB;
use Laravel\Fortify\TwoFactorAuthenticatable;
use Laravel\Jetstream\HasProfilePhoto;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use HasApiTokens;
    use HasFactory;
    use HasProfilePhoto;
    use Notifiable;
    use TwoFactorAuthenticatable;
    use HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */

    public function getRouteKey()
    {
        return 'slug';
    }
    protected $fillable = [
        'name',
        'email',
        'password',
        'slug',
        'fase_corporal'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
        'two_factor_recovery_codes',
        'two_factor_secret',
    ];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array<int, string>
     */
    protected $appends = [
        'profile_photo_url',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function rutinas()
    {
        return $this->hasMany(Rutina::class);
    }

    /**
     * Obtiene el seguimiento asociado con el usuario.
     */
    public function seguimiento()
    {
        return $this->hasMany(Seguimiento::class);
    }

    /**
     * Obtiene las dietas asociadas con el usuario.
     */
    public function dietas()
    {
        return $this->hasMany(Dieta::class);
    }


    // public function getRol()
    // {

    //     $rol = DB::table('roles')
    //         ->where('id', function ($query) {
    //             $query->select('role_id')
    //                 ->from('model_has_roles')
    //                 ->where('model_id', $this->id);
    //         })
    //         ->pluck('name')
    //         ->first();

    //     return $rol;
    // }


}