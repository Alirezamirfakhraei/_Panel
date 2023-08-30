<?php

namespace Modules\User\Repositories;

use Illuminate\Support\Facades\DB;
use Modules\User\Models\User;

class UserRepo
{
    public function index()
    {
        return User::query()->where('id', '!=', auth()->id())->latest()->paginate(15);
    }

    public function findById($id)
    {
//        User::query()->find($id);
        return DB::connection('mysql_second')->table("users")->find($id);
    }

    public function delete($id)
    {
        return User::query()->where('id', $id)->delete();
    }
}
