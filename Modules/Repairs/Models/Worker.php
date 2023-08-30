<?php

namespace Mlk\Repairs\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Worker extends Model
{
    use HasFactory;

    protected $fillable = ['fullname', 'userID', 'api_token', 'isBattery', 'isTire' ,'workerID', 'capacity', 'type', 'city', 'workAreaID', 'password', 'star', 'rate', 'image', 'status', 'extra'];

    public const STATUS_ACTIVE= 'active';
    public const STATUS_INACTIVE = 'inactive';
    public const STATUS_REQUEST = 'request';
    public const STATUS_PENDING = 'pending';
    public const STATUS_SUCCESS = 'success';
    public static array $statuses = [self::STATUS_REQUEST,self::STATUS_ACTIVE,self::STATUS_INACTIVE,self::STATUS_PENDING, self::STATUS_SUCCESS];


    public const WORKER_BRONZE = 'bronze';
    public const WORKER_SILVER = 'silver';
    public const WORKER_GOLD = 'gold';
    public static array $rate = [self::WORKER_BRONZE, self::WORKER_SILVER, self::WORKER_GOLD];

    public const TYPE_BATTERY = 'battery';
    public const TYPE_TIRE = 'tire';
    public static array $type = [self::TYPE_BATTERY, self::TYPE_TIRE];

    protected static function boot()
    {
        parent::boot();
        // auto-sets values on creation
        static::creating(function ($query) {
            $query->rate = self::WORKER_BRONZE;
            $query->api_token = null;
            $query->workerID = self::generateWorkerID();
        });
    }

    public static function generateApiToken($length = 50, $add_dashes = false, $available_sets = 'fuck')
    {
        $sets = array();
        if (str_contains($available_sets, 'f'))
            $sets[] = 'abcdeghjkmnpqrstuvwxyz';
        if (str_contains($available_sets, 'u'))
            $sets[] = 'ABCDEFGHJKMNPQRSTUVWXYZ';
        if (str_contains($available_sets, 'c'))
            $sets[] = '123456789';
        if (str_contains($available_sets, 'k'))
            $sets[] = '!@#$%&*?';
        $all = '';
        $password = '';
        foreach ($sets as $set) {
            $password .= $set[array_rand(str_split($set))];
            $all .= $set;
        }
        $all = str_split($all);
        for ($i = 0; $i < $length - count($sets); $i++)
            $password .= $all[array_rand($all)];

        $password = str_shuffle($password);

        if (!$add_dashes)
            return $password;

        $dash_len = floor(sqrt($length));
        $dash_str = '';
        while (strlen($password) > $dash_len) {
            $dash_str .= substr($password, 0, $dash_len) . '-';
            $password = substr($password, $dash_len);
        }
        $dash_str .= $password;
        return $dash_str;
    }

    private static function generateWorkerID()
    {

        // This function will return
        // A random string of specified length
        function random_strings($length_of_string)
        {
        // random_bytes returns number of bytes
        // bin2hex converts them into hexadecimal format
            return substr(bin2hex(random_bytes($length_of_string)),
                0, $length_of_string);
        }
        return random_strings(8);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
