<?php

namespace Mlk\Repairs\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Repair extends Model
{
    use HasFactory;

    protected $fillable = ['userID', 'telephone', 'issue_date', 'expiration_date', 'steward', 'name', 'lastname',
        'national_code', 'bcNumber', 'fatherName', 'date_of_birth', 'repairID', 'password', 'blue_plate', 'submit_plate',
        'type_of_person', 'type_of_activity', 'union_degree', 'isIc_code', 'address', 'state', 'city', 'province_code',
        'postal_code', 'image', 'area', 'status', 'length', 'width', 'height', 'street_width', 'members', 'latitude', 'longitude', 'repairShop', 'repairOwner'];

    public const STATUS_NEW = 'new';
    public const STATUS_REQUEST = 'request';
    public const STATUS_PENDING = 'pending';
    public const STATUS_SUCCESS = 'success';
    public static array $statuses = [self::STATUS_NEW, self::STATUS_REQUEST, self::STATUS_PENDING, self::STATUS_SUCCESS];


    public const AUTO_GARAGE = 'garage';
    public const AUTO_SERVICE = 'auto_service';
    public const AUTO_SERVICE_PLUS = 'auto_service_plus';
    public const AUTO_SERVICE_SPECIAL = 'auto_service_special';
    public static array $rate = [self::AUTO_GARAGE, self::AUTO_SERVICE, self::AUTO_SERVICE_PLUS, self::AUTO_SERVICE_SPECIAL];

    protected static function boot()
    {
        parent::boot();
        // auto-sets values on creation
        static::creating(function ($query) {
            $query->rate = self::AUTO_GARAGE;
            $query->api_token = null;
        });
    }

    public function generateApiToken($length = 50, $add_dashes = false, $available_sets = 'fuck'): string
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
}
