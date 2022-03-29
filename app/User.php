<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Laravel\Passport\HasApiTokens;

class User extends Authenticatable implements MustVerifyEmail
{
    use Notifiable, HasApiTokens;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'seller_id',
        'customer_id',
        'name',
        'email',
        'apellido',
        'membresia_id',
        'membresia_numero',
        'password',
        'avatar',
        'costo_membresia',
        'fecha_expiracion_documento',
        'canHire',
        'country',
        'isPublic',
        'phone',
        'username',
        'isActive',
        'lastActivity',
        'domicilio',
        'documento',
        'tipo_vendedor',
        'role',
        'state',
        'tier',
        'token_confirmation'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'fecha_expiracion_documento' => 'datetime:Y-m-d',
    ];

    public function seller()
    {
        return $this->belongsTo(Seller::class, 'seller_id');
    }

    public function customer()
    {
        return $this->belongsTo(AdminCustomer::class, 'customer_id');
    }
}
