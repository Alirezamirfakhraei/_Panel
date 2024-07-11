<?php

namespace Modules\User\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\User\Http\Requests\AddUserRequest;
use Modules\User\Repositories\Main\UsersRepository;
use Modules\User\Services\Main\UserService;

class UserSecondDbController extends Controller
{
    // SOLID
    // S => Single Responsibility Principle
    //    public function show($id)
    //    {
    //        abort(404);
    //    }

    public UsersRepository $repository;
    public UserService $service;

    public function __construct(UsersRepository $userRepo, UserService $userService)
    {
        $this->repository = $userRepo;
        $this->service = $userService;
    }

    public function index()
    {
//        $this->authorize('index', User::class);
        $users = $this->repository->index();
        return view('User::index', compact('users'));
    }

    public function create()
    {
//        $this->authorize('index', User::class);
        return view('User::create');
    }

    public function store(AddUserRequest $request)
    {
        $this->service->store($request);
        return to_route('users.index');
    }

    public function destroy($id)
    {
//        $this->authorize('index', User::class);
        $this->service->delete($id);
        return to_route('users.index');
    }

    public function edit($id)
    {
//        $this->authorize('index', User::class);
        $user = $this->repository->findById($id);
        return view('User::edit', compact('user'));
    }

    public function update(Request $request, $id)
    {
//        $this->authorize('index', User::class);
        $this->service->update($request, $id);
        return to_route('users.index');
    }

    public function getUsersInactive()
    {
        $this->repository->getUsersInactive();
        return to_route('users.index');
    }

}
