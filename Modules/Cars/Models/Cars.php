<?php

namespace Modules\Cars\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cars extends Model
{
    use HasFactory;
    protected $fillable = ['userID', 'categoryID' , 'userCreated' ,'carID', 'company', 'model', 'year'
        ,'chassis_number' , 'engine_number', 'plate', 'km_average' ,'km_at' , 'km_current' , 'extra' , 'pin' , 'km_lastReplace' , 'third_insurance' , 'body_insurance'];

    const TEXT = 'IRI';

    public static function generateCarId($codeLength , $mode = null)
    {
        $characters = '0123456789';
        $charactersLength = strlen($characters);
        $randomString = '';
        if ($mode == 'customer') {
            $randomString .= self::TEXT;
            for ($i = 3; $i < $codeLength; $i++) {
                $randomString .= $characters[rand(0, $charactersLength - 1)];
            }
        }else{
            for ($i = 0; $i < $codeLength; $i++) {
                $randomString .= $characters[rand(0, $charactersLength - 1)];
            }
        }

        if (!array_unique(array($randomString)))
        {
            return [];
        }
        return  $randomString;
    }


}
