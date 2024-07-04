<?php

namespace Modules\User\Services\Main;

use Illuminate\Support\Facades\DB;
use helper;

class UserService
{
    private function query()
    {
        return DB::connection('mysql_second')->table("users");
    }

    public function store($request)
    {
        if (!isset($request['userID']) || !$request['userID']) {
            return to_route('users.index')->with(['danger_message' => helper::UserIDNotSend]);
        }
        $findUser = $this->query()->where('userID', $request['userID'])->first();
        if (!$findUser) {
            $create = $this->query()->insert([
                'userID' => $request['userID'],
                'email' => $request['email'],
                'name' => $request['name'],
                'lastname' => $request['lastname'],
                'national_code' => $request['national_code'],
                'telephone' => $request['telephone'],
            ]);
            if ($create) {
                toast(helper::Submit, 'success');
            } else {
                toast(helper::NotInsertNewRecorde, 'error');
            }
            return to_route('users.index');
        } else {
            toast(helper::DuplicateUser, 'error');
            return to_route('users.create');
        }
    }

    public function update($request, $id)
    {
        $attr = $request->validate([
            'name' => 'required|string|max:255|persian_alpha',
            'lastname' => 'required|string|max:255|persian_alpha',
            'address' => 'required|string|max:255',
            'national_code' => 'required|string|digits:10',
            'telephone' => 'required|string|digits:11',
            'email' => 'required|string|email|unique:users,email',
        ]);
        if ($attr) {
            $update = $this->query()->where('id', $id)->update([
                'email' => $request->email,
                'name' => $request->name,
                'lastname' => $request->lastname,
                'national_code' => $request->national_code,
                'address' => $request->address,
                'telephone' => $request->telephone,
            ]);
            if ($update) {
                toast(helper::SubmitRequest, 'success');
            } else {
                toast(helper::SubmitRequest, 'danger');
            }
        }
        return to_route('users.index');
    }

    public function delete($id)
    {
        toast(helper::SubmitRequest, 'success');
        return $this->query()->where('id', $id)->delete();
    }

    public function addRole($user , $role)
    {
        return $user->assignRole($role);
    }
}
