<?php

namespace Modules\ContactUs\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class ContactUs extends Model
{
    use HasFactory;

    public $fillable = ['name','email', 'phone', 'subject', 'message' , 'status'];

    public const STATUS_NEW = 'new';
    public const STATUS_READ = 'unread';
    public static array $statuses = [self::STATUS_NEW, self::STATUS_READ];

    protected static function boot()
    {
        parent::boot();
        // auto-sets values on creation
        static::creating(function ($query) {
            $query->status= self::STATUS_NEW;
        });
    }

}
