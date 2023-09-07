<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Response;

class helper
{
    // ------> General CONST:
    public const SPLIT_SYMBOL = "|";
    public const SPLIT_SYMBOL_DATE = "-";
    // ------> [TRUE]
    public const SubmitRequest = 'عملیات با موفقیت انجام شد';
    public const Submit = 'اطلاعات با موفقیت ثبت شد';
    public const Wrong = 'پارامتر ارسالی اشتباه است!';
    public const NotInsertNewRecorde = 'عدم ذخیره اطلاعات!';
    public const WelcomeToPanel = 'به پنل اسکارپین خوش امدید';
    //------> [FALSE]
    public const WrongData = 'نام کاربری یا رمز عبور اشتباه میباشد';
    public const ParameterNotSend = 'پارامتر مربوطه  ارسال نشد';
    public const UserNotActive = 'کاربر غیرفعال میباشد';
    public const UserIDNotSend = 'شماره موبایل وارد نشده است';
    public const CarNotFound = 'شناسه ماشین یافت نشد';
    public const RepairNotFound = 'شناسه صنفی مورد نظر پیدا نشد';
    public const UserNotFound = 'کاربر مورد نظر پیدا نشد';
    public const DuplicateUser = 'کابر قبلا در سامانه عضو شده است';
    public const DuplicatePlate = 'پلاک وارد شده تکراری میباشد';
    public const DuplicateTradeID = 'شناسه صنفی وارد شده تکراری میباشد!';
    public const Error = 'مشکلی پیش آمده است، لطفا چند دقیقه بعد مجدد اقدام کنید';
    public const WrongYearForCar = 'سال تولید خودرو اشتباه ثبت شده است';
    public const CategoryNotSend = 'دسته بندی خودرو وارد نشده است';
    public const CategoryNotFound = 'دسته بندی خودرو پیدا نشد';
    public const ServiceNotFound = 'سرویسی برای خودرو پیدا نشد';



    public function getData()
    {
        $post = null;
        //اگر از طریق پست چیزی اومد و خالی نبود بریز تو post
        if (isset($_POST) && $_POST != null) {
            $post = $_POST;
        }
        //اگر post خالی بود ینی از سمت postman چیزی اومد به صورت decode برام بریز توی post
        if ($post == null) {
            $post = json_decode(file_get_contents('php://input'), true);
        }
        return $post;
    }

    public function getaddress($lat, $lng)
    {
        return "https://www.google.com/maps?ll=$lat,$lng";
    }

    public function getAddressFromNeshan(Request $request)
    {
        $help = new helper();
        if (!isset($request['lat']) && !isset($request['lng'])) {
            return $help->response('ParameterNotSend', 200, ['parameters' => 'lat | lng'], helper::ParameterNotSend);
        }
        $response = Http::withHeaders([
            'Api-Key' => 'service.4ce3765606764a81a04196c470bbb767'
        ])->get('https://api.neshan.org/v5/reverse?lat=LATITUDE&lng=LONGITUDE', [
            'lat' => $request['lat'],
            'lng' => $request['lng'],
        ]);
        $result = $response->json();
        $array = [
            'city' => $result['city'],
            'formatted_address' => $result['formatted_address']
        ];
        return $help->response('Submit', 200, $array, helper::SubmitRequest);
    }

    public function getUrlPath($mode, $type, $folderName, $fileName, $formatFile)
    {
        $path = '/storage/' . $type . '/' . $folderName . '/' . $fileName . '.' . $formatFile;
        if ($mode == 'URL') {
            return asset($path);
        } elseif ($mode == "MAKE") {
            $file = File::get($path);
            $type = File::mimeType($path);

            $response = Response::make($file, 200);
            $response->header("Content-Type", $type);

            return $response;
        } else {
            return null;
        }
    }

    public function response($mode, $code, $data, $message)
    {
        $error = false;
        if ($code >= 400) {
            $error = true;
        }
        if ($data == null) {
            return \response()->json([
                'Mode' => $mode,
                'Code' => $code,
                'data' => null,
                'Error' => $error,
                'Message' => $message,
            ]);
        } else {
            return \response()->json([
                'Mode' => $mode,
                'Code' => $code,
                'Error' => $error,
                'Data' => $data,
                'Message' => $message,
            ]);
        }
    }

    public function kavenegar($phone, $template, $token = null, $token2 = null, $token3 = null, $type = null, $token10 = null, $token20 = null)
    {
        try {
            $api = new Kavenegar\KavenegarApi('435871552F56317972417171697A754F43504E326F7A7A57766B7379467371737A3632747A696A695674553D');
            $api->VerifyLookup($phone, $token, $token2, $token3, $template, $type, $token10, $token20);
            return true;
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }

    public function WriteExtra($key, $replaceValue, $text)
    {
        $keyIsExist = false;
        $result = "";
        if ($text == "") {
            if ($replaceValue == null) {
                $result = $key;
            } else {
                $result = $key . "=" . $replaceValue;
            }
        } else {
            $items = explode(self::SPLIT_SYMBOL, $text);
            for ($i = 0; $i < count($items); $i++) {
                $keysString = explode("=", $items[$i]);
                $result .= $keysString[0];
                if ($keysString[0] == $key) {
                    $keyIsExist = true;
                    if ($replaceValue != null) {
                        $result .= "=" . $replaceValue;
                    }
                } else {
                    if (count($keysString) > 1) {
                        $result .= "=" . $keysString[1];
                    }
                }
                if ($i < (count($items) - 1)) {
                    $result .= self::SPLIT_SYMBOL;
                }
            }
            if (!$keyIsExist) {
                $result .= self::SPLIT_SYMBOL;
                $result .= $key;
                if ($replaceValue != null) {
                    $result .= "=" . $replaceValue;
                }
            }
        }
        return $result;
    }

    public function ReadExtra($key, $text)
    {
        $result = null;
        $items = explode(self::SPLIT_SYMBOL, $text);
        for ($i = 0; $i < count($items); $i++) {
            $keysString = explode("=", $items[$i]);
            if ($keysString[0] == $key) {
                $result = $keysString[1];
                break;
            }
        }
        return $result;
    }

    public function CheckExtraKey($key, $text, $value = null)
    {
        $result = false;
        $items = explode(self::SPLIT_SYMBOL, $text);
        for ($i = 0; $i < count($items); $i++) {
            $paramString = explode("=", $items[$i]);
            if ($paramString[0] == $key) {
                if ($value != null) {
                    try {
                        if ($paramString[1] == $value) {
                            $result = true;
                            break;
                        }
                    } catch (Exception $e){
                        break;
                    }
                } else {
                    $result = true;
                    break;
                }
            }
        }
        return $result;
    }

    public function CheckDate($extraData, $date, $dateParam = "Complete", $checkMode = null)
    {
        $error = false;
        $massage = "";
        $date_year = null;
        $date_month = null;
        $date_day = null;
        $lowerMiladiYear = 1950;
        $lowerShamsiYear = 1330;
        $date_current = verta();
        $result = ['error' => false, 'massage' => $massage];

        if ($dateParam == "Complete") {
            $dateSplit = explode(self::SPLIT_SYMBOL_DATE, $date);
            $date_year = $dateSplit[0];
            $date_month = $dateSplit[1];
            $date_day = $dateSplit[2];
        }
        if ($dateParam == "year") {
            $date_year = (int)$date;
        }
        if ($dateParam == "month") {
            $date_month = (int)$date;
        }
        if ($dateParam == "day") {
            $date_day = (int)$date;
        }

        // ------> Default Check:
        if ($date_year != null) {
            if ($date_year < $lowerMiladiYear) {
                if ($date_year > ($date_current->year + 1) || $date_year < $lowerShamsiYear) {
                    $error = true;
                }
            } else {
                if ($date_year > $date_current->toCarbon()->year + 1) {
                    $error = true;
                }
            }
        }
        if ($date_month != null) {
            if ($date_month > 12 || $date_month < 0) {
                $error = true;
            }
        }
        if ($date_month != null && $date_day != null) {
            if ($date_month > 6 && $date_day > 32) {
                $error = true;
            } elseif ($date_month < 6 && $date_day > 32) {
                $error = true;
            } elseif ($date_day < 0) {
                $error = true;
            }
        }
        if ($error) {
            $result['error'] = true;
            $result['massage'] = "Default Error";
        } else {
            // ------> Main Check:
            if ($checkMode != null) {
                if ($checkMode = "CarThirdInsurance") {
                    $carCreated = $extraData['year'];
                    if ($carCreated > $lowerMiladiYear) {
                        $carCreated = verta($extraData['year'] . '-' . $date_month . '-' . $date_day)->year;
                    }
                    if ($date_year < $carCreated) {
                        $result['error'] = true;
                        $result['massage'] = "Year is Wrong";
                    }
                }
            }
        }
        return $result;
    }

    public function showTruePlate($data, $mode)
    {
        $plate = preg_split('//u', $data, -1, PREG_SPLIT_NO_EMPTY);
        $P1 = "$plate[0]$plate[1]";
        $P2 = "$plate[7]";
        $P3 = "$plate[2]$plate[3]$plate[4]";
        $P4 = "$plate[5]$plate[6]";
        if ($mode == "1") {
            return "$P4-$P3$P2";
        } else {
            return "$P1";
        }
    }

    public function calculate($KmReplace, $KmCurrent, $KmRequest)
    {
        $mines = ($KmReplace + $KmRequest) - $KmCurrent;
        if ($KmRequest > 0) {
            $percentUsed = ($mines / $KmRequest) * 100;
        } else {
            $percentUsed = "Error Math";
        }
        $round = ceil($percentUsed);
        if ($round % 2 == 0) {
            $per = $round;
        } else {
            $per = $round - 1;
        }
        if ($per > 100) {
            $per = 100;
        } elseif ($per < 0) {
            $per = 0;
        }
        return $per;
    }
}
