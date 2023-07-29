<?php

namespace Mlk\User\Repositories;

use Illuminate\Support\Facades\DB;
use Mlk\User\Models\User;

class UserRepo
{
    public function index()
    {
//        return User::query()->where('id', '!=', auth()->id())->latest()->paginate(10);
        return DB::connection('mysql_second')->table("users")->latest()->paginate(20);
    }

    public function findById($id)
    {
        return User::query()->findOrFail($id);
    }

    public function delete($id)
    {
        return User::query()->where('id', $id)->delete();
    }
}
