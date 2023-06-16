<?php

namespace Modules\Users\Models;
use Tymon\JWTAuth\Contracts\JWTSubject;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable implements JWTSubject
{

    use HasApiTokens, HasFactory, Notifiable;
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'userID',
        'email',
        'role',
        'gender',
        'fullName',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    public function getJWTCustomClaims()
    {
        return [];
    }
    public const STATUS_ACTIVE = 'active';
    public const STATUS_INACTIVE = 'inactive';
    public static array $status = [self::STATUS_ACTIVE , self::STATUS_INACTIVE];

    public const ROLE_ADMIN = 'admin';
    public const ROLE_SUPER_ADMIN= 'super_admin';
    public const  ROLE_CUSTOMER = 'customer';
    public static array $roles = [self::ROLE_ADMIN , self::ROLE_SUPER_ADMIN , self::ROLE_CUSTOMER];

    protected static function boot()
    {
        parent::boot();
        // auto-sets values on creation
        static::creating(function ($query) {
            $query->status = self::STATUS_ACTIVE;
            $query->role = self::ROLE_ADMIN;
        });
    }

    public function setPasswordAttribute($password)
    {
        $this->attributes['password'] = bcrypt($password);
    }

}
