<?php

namespace Modules\Cars\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cars extends Model
{
    use HasFactory;

    protected $fillable = [
        'userID', 'categoryID', 'userCreated', 'carID', 'company',
        'model', 'year', 'chassis_number', 'engine_number', 'plate',
        'km_average', 'km_at', 'km_current', 'extra', 'pin',
        'km_lastReplace', 'third_insurance', 'body_insurance'
    ];

    public const TEXT = 'IRI';
    public const QR = 'qr';
    public const EXPIRATION_TIME = 30;
    public static function generateQrCode($codeLength, $mode = null)
    {
        $characters = 'qpwoeirutylaksjdhfgmznxcbv';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $codeLength; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        if (Cars::query()->where('carID', $randomString)->exists()) {
            return $randomString . 'Z';
        }
        return $randomString;
    }
    public static function generateCarId($codeLength, $mode = null)
    {
        $characters = '0123456789';
        $charactersLength = strlen($characters);
        $randomString = '';
        if ($mode == 'customer') {
            $randomString .= self::TEXT;
            for ($i = 3; $i < $codeLength; $i++) {
                $randomString .= $characters[rand(0, $charactersLength - 1)];
            }
        } else {
            for ($i = 0; $i < $codeLength; $i++) {
                $randomString .= $characters[rand(0, $charactersLength - 1)];
            }
        }
        if (Cars::query()->where('carID', $randomString)->exists()) {
            return $randomString . '1';
        }
        return $randomString;
    }

    public function isExpired($token)
    {
        $timeDifference = Carbon::now()->diffInMinutes($token['created_at']);
        if ($timeDifference < self::EXPIRATION_TIME) {
            return false;
        } else {
            return true;
        }
    }

    //Relations

}
