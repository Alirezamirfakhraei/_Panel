<?php

use Mlk\Cars\Models\Cars;
use Mlk\Repairs\Models\Repair;
use Modules\Services\Models\Service;
use Modules\Users\Models\User;

class Functions
{
    public function ValidationData($condition, $input)
    {
        $type = null;
        $data = null;
        $mode = null;
        $message = null;
        $error = false;
        if ($condition == 'user') {
            if (isset($input['repairID'])) {
                $user = Repair::query()->where('api_token', $input['api_token'])->where('repairID', $input['repairID'])->first();
                if (!$user) {
                    $mode = "RepairNotFound";
                    $error = true;
                    $message = helper::RepairNotFound;
                } else {
                    $type = 'repairID';
                    $data = $user;
                }
            } elseif (isset($input['userID'])) {
                $user = User::query()->where('api_token', $input['api_token'])->where('userID', $input['userID'])->first();
                if (!$user) {
                    $mode = "UserNotFound";
                    $error = true;
                    $message = helper::UserNotFound;
                } else {
                    $type = 'userID';
                    $data = $user;
                }
            }
        } elseif ($condition == 'car') {
            if (isset($input['plate'])) {
                $car = Cars::query()->where('plate', $input['plate'])->first();
                if (!$car) {
                    $mode = "CarNotFound";
                    $error = true;
                    $message = helper::CarNotFound;
                } else {
                    $data = $car;
                }
            } elseif (isset($input['carID'])) {
                $car = Cars::query()->where('carID', $input['carID'])->first();
                if (!$car) {
                    $mode = "CarNotFound";
                    $error = true;
                    $message = helper::CarNotFound;
                } else {
                    $data = $car;
                }
            } elseif (isset($input['accessToken'])) {
                $defaultRequest = true;
                $splitToken = explode(Cars::QR, $input['accessToken']);
                if (count($splitToken) > 0) {
                    $car = Cars::query()->Where('carID', $splitToken[0])->first();
                    if (!($car && $car['accessToken'] == $splitToken[1])) {
                        $mode = "CarNotFound";
                        $error = true;
                        $message = helper::CarNotFound;
                    } else {
                        $defaultRequest = false;
                    }
                } else {
                    $mode = "Wrong";
                    $error = true;
                    $message = helper::Wrong;
                }
                $data = $defaultRequest;
            } else {
                $error = true;
            }
        }
        if ($error) {
            return ['type' => $type, 'mode' => $mode, 'error' => true, 'message' => $message];
        } else {
            return ['type' => $type, 'data' => $data, 'error' => false];
        }
    }

    public function syncAt($carID)
    {
        $update = Cars::query()->where('carID', $carID['carID'])->update([
            'sync_at' => date('Y-m-d H:i:s'),
        ]);
        if ($update) {
            return true;
        }
        return false;
    }

    /**
     * In this function average car mileage is calculated based on two received parameters.
     *
     * @param  $km
     * @param  $item
     * @return float|int|void
     * @version <RejUserController/v1>
     */
    public function calculateKmAverage($km, $item)
    {
        if (isset($km)) {
            $year = $item['year'];
            $month = explode("-", $item['third_insurance']);
            $day = explode("-", $item['third_insurance']);
            if (($month[1] > 11) || ($month[1] == 11 && $day[2] >= 22)) {
                $year = $year - 1;
            }
            $newDate = date_create(now());
            $shamsiDate = date_create(jdate($newDate)->format('Y-m-d'));
            $oldDate = $year . "-" . $month[1] . "-" . $day[2];
            $res = date_create(json_decode(json_encode($oldDate)));
            $interval = date_diff($res, $shamsiDate);
            $countYear = (int)$interval->format('%y year');
            $countMonth = (int)$interval->format('%m month');
            $countDay = (int)$interval->format('%d day');
            if ($countMonth != null) {
                $average = $km / (($countYear * 12) + $countMonth + ($countDay / 30));
                $result = ceil($average / 100) * 100;
            } else {
                $result = 0;
            }
            return $result;
        }
    }

    public function setPiece($carID, $input)
    {
        for ($j = 0; $j < 8; $j++) {
//          $ShortNum = ($request['km_current'] - $request['km_lastReplace']) / Service::STANDARD_USER_SHORT_LOWER[Service::PIECENAME_SHORT[$j]];
//          $ShortMines = (Service::STANDARD_USER_SHORT_LOWER[Service::PIECENAME_SHORT[$j]] * intval($ShortNum));
            Service::query()->create([
                'carID' => $carID,
                'servicerID' => $input['userID'],
                'referenceID' => 'systemEngine',
                'repairMan' => 'system',
                'pieceName' => Service::PIECENAME_SHORT[$j],
                'kmReplace' => $input['km_lastReplace'],
                'kmRequest' => Service::STANDARD_USER_SHORT_LOWER[Service::PIECENAME_SHORT[$j]],
                'description' => 'Generated With ScarPin System Engine (AI)',
                'type' => Service::TYPE_SHORT,
                'mode' => 'ai',
            ]);
            $MiddleNum = $input['km_current'] / Service::STANDARD_USER_MIDDLE[Service::PIECENAME_MIDDLE[$j]];
            $MiddleMines = (Service::STANDARD_USER_MIDDLE[Service::PIECENAME_MIDDLE[$j]] * intval($MiddleNum));
            Service::query()->create([
                'carID' => $carID,
                'servicerID' => $input['userID'],
                'referenceID' => 'systemEngine',
                'repairMan' => 'system',
                'pieceName' => Service::PIECENAME_MIDDLE[$j],
                'kmReplace' => $MiddleMines,
                'kmRequest' => Service::STANDARD_USER_MIDDLE[Service::PIECENAME_MIDDLE[$j]],
                'description' => 'Generated With ScarPin System Engine (AI)',
                'type' => Service::TYPE_MID,
                'mode' => 'ai',
            ]);
            $LongNum = $input['km_current'] / Service::STANDARD_USER_LONG[Service::PIECENAME_LONG[$j]];
            $LongMines = (Service::STANDARD_USER_LONG[Service::PIECENAME_LONG[$j]] * intval($LongNum));
            Service::query()->create([
                'carID' => $carID,
                'servicerID' => $input['userID'],
                'referenceID' => 'systemEngine',
                'repairMan' => 'system',
                'pieceName' => Service::PIECENAME_LONG[$j],
                'kmReplace' => $LongMines,
                'kmRequest' => Service::STANDARD_USER_LONG[Service::PIECENAME_LONG[$j]],
                'description' => 'Generated With ScarPin System Engine (AI)',
                'type' => Service::TYPE_LONG,
                'mode' => 'ai',
            ]);
            return true;
        }
        return false;
    }

    public function checkIsset($request, $issetKeys)
    {
        $mode = null;
        $error = false;
        for ($i = 0; $i < count($issetKeys); $i++) {
            if (!isset($request[$issetKeys[$i]]) || isset($request[$issetKeys[$i]]) == null) {
                $error = true;
                $mode = $issetKeys[$i];
                break;
            }
        }
        if ($error) {
            return ['mode' => $mode, 'error' => true];
        } else {
            return ['error' => false];
        }
    }

    public function validatePlate($character)
    {
        $partCharacterUniCode = null;
        switch ($character) {
            case "الف":
                $partCharacterUniCode = "01";
                break;
            case "ب":
                $partCharacterUniCode = "02";
                break;
            case "پ":
                $partCharacterUniCode = "03";
                break;
            case "ت":
                $partCharacterUniCode = "04";
                break;
            case "ث":
                $partCharacterUniCode = "05";
                break;
            case "ج":
                $partCharacterUniCode = "06";
                break;
            case "چ":
                $partCharacterUniCode = "07";
                break;
            case "ح":
                $partCharacterUniCode = "08";
                break;
            case "خ":
                $partCharacterUniCode = "09";
                break;
            case "د":
                $partCharacterUniCode = "10";
                break;
            case "ذ":
                $partCharacterUniCode = "11";
                break;
            case "ر":
                $partCharacterUniCode = "12";
                break;
            case "ز":
                $partCharacterUniCode = "13";
                break;
            case "ژ":
                $partCharacterUniCode = "14";
                break;
            case "س":
                $partCharacterUniCode = "15";
                break;
            case "ش":
                $partCharacterUniCode = "16";
                break;
            case "ص":
                $partCharacterUniCode = "17";
                break;
            case "ض":
                $partCharacterUniCode = "18";
                break;
            case "ط":
                $partCharacterUniCode = "19";
                break;
            case "ظ":
                $partCharacterUniCode = "20";
                break;
            case "ع":
                $partCharacterUniCode = "21";
                break;
            case "غ":
                $partCharacterUniCode = "22";
                break;
            case "ف":
                $partCharacterUniCode = "23";
                break;
            case "ق":
                $partCharacterUniCode = "24";
                break;
            case "ک":
                $partCharacterUniCode = "25";
                break;
            case "گ":
                $partCharacterUniCode = "26";
                break;
            case "ل":
                $partCharacterUniCode = "27";
                break;
            case "م":
                $partCharacterUniCode = "28";
                break;
            case "ن":
                $partCharacterUniCode = "29";
                break;
            case "و":
                $partCharacterUniCode = "30";
                break;
            case "ه":
                $partCharacterUniCode = "31";
                break;
            case "ی":
                $partCharacterUniCode = "32";
                break;
            case "D":
                $partCharacterUniCode = "33";
                break;
            case "S":
                $partCharacterUniCode = "34";
                break;
            case "&":
                $partCharacterUniCode = "35";
                break;
        }
        return $partCharacterUniCode;
    }


    public function truePlateView($value)
    {
        $partCharacterUniCode = null;
        $plate = str_split($value, 2);
        switch ($plate[1]) {
            case "01":
                $partCharacterUniCode = "الف";
                break;
            case "02":
                $partCharacterUniCode = "ب";
                break;
            case "03":
                $partCharacterUniCode = "پ";
                break;
            case "04":
                $partCharacterUniCode = "ت";
                break;
            case "05":
                $partCharacterUniCode = "ث";
                break;
            case "06":
                $partCharacterUniCode = "ج";
                break;
            case "07":
                $partCharacterUniCode = "چ";
                break;
            case "08":
                $partCharacterUniCode = "ح";
                break;
            case "09":
                $partCharacterUniCode = "خ";
                break;
            case "10":
                $partCharacterUniCode = "د";
                break;
            case "11":
                $partCharacterUniCode = "ذ";
                break;
            case "12":
                $partCharacterUniCode = "ر";
                break;
            case "13":
                $partCharacterUniCode = "ز";
                break;
            case "14":
                $partCharacterUniCode = "ژ";
                break;
            case "15":
                $partCharacterUniCode = "س";
                break;
            case "16":
                $partCharacterUniCode = "ش";
                break;
            case "17":
                $partCharacterUniCode = "ص";
                break;
            case "18":
                $partCharacterUniCode = "ض";
                break;
            case "19":
                $partCharacterUniCode = "ط";
                break;
            case "20":
                $partCharacterUniCode = "ظ";
                break;
            case "21":
                $partCharacterUniCode = "ع";
                break;
            case "22":
                $partCharacterUniCode = "غ";
                break;
            case "23":
                $partCharacterUniCode = "ف";
                break;
            case "24":
                $partCharacterUniCode = "ق";
                break;
            case "25":
                $partCharacterUniCode = "ک";
                break;
            case "26":
                $partCharacterUniCode = "گ";
                break;
            case  "27":
                $partCharacterUniCode = "ل";
                break;
            case "28":
                $partCharacterUniCode = "م";
                break;
            case "29":
                $partCharacterUniCode = "ن";
                break;
            case "30":
                $partCharacterUniCode = "و";
                break;
            case "31":
                $partCharacterUniCode = "ه";
                break;
            case "32":
                $partCharacterUniCode = "ی";
                break;
            case "33":
                $partCharacterUniCode = "D";
                break;
            case "34":
                $partCharacterUniCode = "S";
                break;
            case "35":
                $partCharacterUniCode = "&";
                break;
        }
        return $partCharacterUniCode;
    }

}