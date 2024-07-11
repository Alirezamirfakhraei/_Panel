<?php

namespace Modules\User\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\User\Http\Requests\AddRoleRequest;
use Modules\User\Http\Requests\UserRequest;
use Modules\User\Http\Requests\UserUpdateRequest;
use Modules\User\Models\User;
use Modules\User\Repositories\UserRepo;
use Modules\User\Services\UserService;

class UserController extends Controller
{

    public UserRepo $repo;
    public UserService $service;

    public function __construct(UserRepo $userRepo, UserService $userService)
    {
        $this->repo = $userRepo;
        $this->service = $userService;
    }

    public function index()
    {
        $users = $this->repo->index();
        return view('User::index', compact('users'));
    }

    public function create()
    {
        $this->authorize('index', User::class);
        return view('User::create');
    }

    public function store(UserRequest $request)
    {
        $this->service->store($request);
        return to_route('users.index');
    }

    public function edit($id)
    {
        $user = $this->repo->findById($id);
        return view('User::edit', compact('user'));
    }

    public function update(UserUpdateRequest $request, $id)
    {
        $this->service->update($request, $id);
        return to_route('users.index');
    }

    public function destroy($id)
    {
        $this->authorize('index', User::class);
        $this->repo->delete($id);
        return to_route('users.index')->with(['success_delete' => 'کاربر با موفقیت حذف شد']);
    }

    // Role
    public function addRole($user_id, RoleRepo $roleRepo)
    {
        $roles = $roleRepo->index()->get();
        return view('User::add-roles', compact(['user_id', 'roles']));
    }

    public function addRoleStore(AddRoleRequest $request, $userId)
    {
        $user = $this->repo->findById($userId);
        $this->service->addRole($request->role, $user);
        alert()->success('اد کردن مقام به کاربر', 'عملیات با موفقیت انجام شد');
        return to_route('users.index');
    }

    public function removeRole($userId, $roleId, RoleRepo $roleRepo)
    {
        $user = $this->repo->findById($userId);
        $role = $roleRepo->findById($roleId);
        $this->service->deleteRole($user, $role->name);
        alert()->success('حذف کردن مقام', 'عملیات با موفقیت انجام شد');
        return to_route('users.index');
    }
}
