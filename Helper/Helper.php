    <?php

    use Illuminate\Support\Facades\File;
    use Illuminate\Support\Facades\Response;

    class helper
    {
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

        public function create($title, $message, $level, $key = 'flash_message')
        {
            return session()->flash($key, [
                'title'    =>   $title,
                'message'  =>   $message,
                'level'     =>  $level
            ]);
        }
    }
