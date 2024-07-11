<?php

namespace Modules\User\Repositories\Main;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Modules\User\Models\User;

class UsersRepository
{
    public function index()
    {
        return DB::connection('mysql_second')->table("users")->latest()->paginate(15);
    }

    public function findById($id)
    {
        return DB::connection('mysql_second')->table("users")->find($id);
    }

    public function delete($id)
    {
        return User::query()->where('id', $id)->delete();
    }

    public function getUsersInactive()
    {
        return DB::connection('mysql_second')->table("users")->where('name', null)->where('lastname' , null)->latest()->paginate(15);
    }
}
