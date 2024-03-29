<?php

namespace Modules\User\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Modules\Category\Models\Category;
use Overtrue\LaravelLike\Traits\Liker;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable implements MustVerifyEmail
{
    use HasApiTokens, HasFactory, Notifiable, HasRoles, Liker;

//    protected $connection = 'mysql_second';

    protected $fillable = [
        'email', 'password','userID', 'status'
    ];

    protected $hidden = ['password', 'remember_token'];

    protected $casts = ['email_verified_at' => 'datetime'];


    protected static function boot()
    {
        parent::boot();
        // auto-sets values on creation
        static::creating(function ($query) {
            $query->status = self::STATUS_INACTIVE;
            $query->role = 'admin';
        });
    }

    // Variables
    public const STATUS_ACTIVE = 'active';
    public const STATUS_INACTIVE = 'inactive';
    public static array $statuses = [self::STATUS_ACTIVE, self::STATUS_INACTIVE];

    // Methods
    public function textStatusEmailVerifiedAt(): string
    {
        if ($this->email_verified_at) return 'تایید شده';

        return 'تایید نشده';
    }

    public function cssStatusEmailVerifiedAt(): string
    {
        if($this->email_verified_at) return 'success';

        return 'danger';
    }

    public function path()
    {
        return route('users.author', $this->name);
    }

    public function image()
    {
        return asset('assets/imgs/logo2.svg');
    }

    // Relations
    public function categories()
    {
        return $this->hasMany(Category::class);
    }

    public function articles()
    {
        return $this->hasMany(Article::class);
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    public function advertisings()
    {
        return $this->hasMany(Advertising::class);
    }
}
