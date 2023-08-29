<?php

namespace Mlk\ContactUs\Services;

use Exception;
use Functions;
use helper;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Mlk\ContactUs\Models\ContactUs;

class ContactUsService
{

    /**
     * This is function about send ticket by users To us.
     * @param Request $request
     * @return JsonResponse
     * @throws Exception
     * @version <RejUserController/v1>
     */
    public function store(Request $request): JsonResponse
    {
        DB::beginTransaction();
        try {
            $help = new helper();
            $func = new Functions();
            $array = ['phone', 'name' , 'email' , 'subject' , 'message'];
            $checkIsset = $func->checkIsset($request , $array);
            if ($checkIsset['error']) {
                return $help->response('ParameterNotSend', 400, $checkIsset['mode'], helper::ParameterNotSend);
            }
            $message = ContactUs::query()->create([
                'name' => $request['name'],
                'email' => $request['email'],
                'phone' => $request['phone'],
                'subject' => $request['subject'],
                'message' => $request['message'],
            ]);
            DB::commit();
            if ($message) {
                return $help->response('Submit', 200, true, helper::Submit);
            } else {
                DB::rollBack();
                return $help->response('NotInsertNewRecorde', 400, false, helper::NotInsertNewRecorde);
            }
        } catch (\Exception $exception) {
            DB::rollBack();
            throw $exception;
        }
    }
}
