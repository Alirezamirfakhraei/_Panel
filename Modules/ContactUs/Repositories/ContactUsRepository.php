<?php

namespace Modules\ContactUs\Repositories;

use Illuminate\Support\Facades\DB;
use Modules\ContactUs\Models\ContactUs;

class ContactUsRepository
{

    public function query()
    {
        return DB::connection('mysql_second')->table('contact_us');
    }

    public function index()
    {
        return $this->query()->latest()->paginate(15);
    }

    public function findById($id)
    {
        return $this->query()->where('id' , $id)->first();
    }

    public function changeStatus($message)
    {
        if ($message->status == ContactUs::STATUS_NEW){
            return $this->query()->where('id' , $message->id)->update(['status' => ContactUs::STATUS_READ]);
        }
    }

}
