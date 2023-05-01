    <?php

    use Illuminate\Support\Facades\File;
    use Illuminate\Support\Facades\Response;

    class helper
    {
        // ------> Massages [FALSE]:
        public const WrongParameter = 'پارامتر ارسالی اشتباه است ، لطفا در وارد کردن اطلاعات دقت فرمائید!';
        public const CarNotFound = 'شناسه ماشین یافت نشد!';
        public const AgentNotFound = 'شناسه تعمیرگاه یافت نشد!';
        public const UserNotFound = 'کاربر مورد نظر یافت نشد!';
        public const referenceIDNotFound = 'عدم وجود کد مرجع برای این شناسه ماشین! لطفا کد مرجع را بررسی کنید!';
        public const ParameterNotFound = 'پارامتر مربوطه یافت نشد!';
        public const ParameterNotSent = 'پارامتر مربوطه ارسال نشد!';
        public const InfoNotRecordeOnService = 'رکوردی برای این شناسه ماشین ثبت نشده است! بار اول مراجعه این خودرو می باشد';
        public const IllogicalData = 'مقادیر نا معقولی وارد شده است، از صحت اطلاعات اطمینان حاصل فرمایید';
        public const IsValid = 'مقادیر نامعلوم وارد شده است، لطفا بعد از تاییدیه تعیرکار مقادیر را ارسال کنید!';
        public const Wrong = 'پارامتر ارسالی اشتباه است!';
        public const NotInsertNewRecorde = 'عدم ذخیره اطلاعات!';
        public const IncompatibilityData = 'عدم تطابق!';
        public const ReferenceModeEnded = 'درخواست خاته یافته است!';
        public const AccessDenied = 'دسترسی امکان پذیر نمی باشد.';
        public const AccessDeniedStatusRepair = 'تعمیرکار در وضعیت تایید قرار ندارد!';
        public const DuplicateParameter = 'مقدار وارد شده تکراری میباشد!';
        public const Could_Not_Uploaded = 'عکس آپلود نشد دوباره امتحان کنید';
        public const ExpireToken = 'کد وارد شده منقضی شده است.';
        public const DuplicateTradeID = 'مقدار وارد شده تکراری میباشد!';
        public const DuplicateUser = ' کاربری با این شماره وجود دارد!';
        public const categoryNotFound = ' دسته بندی مورد نظر وجود ندارد!';
        public const Error = 'مشکلی پیش آمده است ، لطفا چند دقیقه بعد مجدد اقدام کنید';
        public const ProcessAgain = 'سرویس این خودرو به پایان رسید ، لطفا دوباره درخواست را اجر کنید';
        public const IncorrectReferenceId = 'کد مرجع کاربر برای عملیات مربوطه اشتباه میباشد!';

        // ------> Massages [TRUE]:
        public const Submit = 'با موفقیت ارسال شد';

        // ------> CONST PARAMS:
        public const SPLIT_SYMBOL = "|";
        public const SPLIT_SYMBOL_DATE = "-";


        public function  showMessageError($mode , $error, $data, $message, $codeStatus): \Illuminate\Http\JsonResponse
        {
            $result = [
                'code' => $codeStatus,
                'error' => $error,
                'mode' => $mode,
                'message' => $message,
                'data' => $data
            ];
            return response()->json($result);
        }


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

        public function calculate($KmReplace, $KmCurrent, $KmRequest)
        {
            $mines = ($KmReplace + $KmRequest) - $KmCurrent;
            if ($KmRequest > 0) {
                $percentUsed = ($mines / $KmRequest) * 100;
            } else {
                $percentUsed = "Error Math";
            }
            $per = 0;
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

        public function kavenegar($phone, $template, $token = null, $token2 = null, $token3 = null, $type = null)
        {
            try {
                $api = new Kavenegar\KavenegarApi('435871552F56317972417171697A754F43504E326F7A7A57766B7379467371737A3632747A696A695674553D');
                $api->VerifyLookup($phone, $token, $token2, $token3, $template, $type = null);
                return true;
            } catch (\Exception $e) {
                return false;
            }
        }
    }
