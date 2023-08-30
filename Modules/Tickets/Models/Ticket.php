<?php

namespace Modules\Tickets\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ticket extends Model
{
    use HasFactory;

    public $fillable = ['name', 'email','title', 'supportID' ,'type','ticketID','userID','phone', 'subject', 'message' , 'status' , 'file'];

    public const PRIORITY_LOW = 'low';
    public const PRIORITY_NORMAL = 'normal';
    public const  PRIORITY_HIGH = 'high';
    public static array $priority = [self::PRIORITY_LOW, self::PRIORITY_NORMAL ,self::PRIORITY_HIGH];


    public const  STATUS_NEW = 'new';
    public const STATUS_EXPECTATION = 'expectation';
    public const STATUS_END = 'end';
    public static array $statuses = [self::STATUS_NEW, self::STATUS_EXPECTATION ,self::STATUS_END];

    public const  TYPE_USER = 'user';
    public const TYPE_REPAIR = 'repair';
    public const TYPE_WRONG_CAR = 'wrongCar';
    public static array $types = [self::TYPE_USER,self::TYPE_REPAIR , self::TYPE_WRONG_CAR];



    public static function randTicketID()
    {
        $characters = '0123456789';
        $charactersNumber = strlen($characters);
        $code = '';
        while (strlen($code) < 6) {
            $position = rand(0, $charactersNumber - 1);
            $character = $characters[$position];
            $code = $code . $character;
        }
        if (Ticket::query()->where('ticketID', $code)->exists()) {
            return 'T'.$code;
        }
        return $code;
    }

    protected static function boot()
    {
        parent::boot();
        // auto-sets values on creation
        static::creating(function ($query) {
            $query->status= 'new';
        });
    }
}
