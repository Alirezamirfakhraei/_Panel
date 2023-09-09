<?php

namespace Modules\Role\Http\Controllers;

use Modules\Role\Http\Requests\RoleRequest;
use Modules\Role\Models\Role;
use Modules\Role\Repositories\PermissionRepo;
use Modules\Role\Repositories\RoleRepo;
use Modules\Role\Services\RoleService;
use Modules\Share\Http\Controllers\Controller;

class RoleController extends Controller
{
    public RoleRepo $repo;
    public RoleService $service;

    public function __construct(RoleRepo $roleRepo, RoleService $roleService)
    {
        $this->repo = $roleRepo;
        $this->service = $roleService;
    }

    public function index()
    {
        $this->authorize('index', Role::class);
        $roles = $this->repo->index()->paginate(15);
        return view('Role::index', compact('roles'));
    }

    public function create(PermissionRepo $permissionRepo)
    {
//        $this->authorize('index', Role::class);
        $permissions = $permissionRepo->all();

        return view('Role::create', compact('permissions'));
    }

    public function store(RoleRequest $request)
    {
//        $this->authorize('index', Role::class);
        $this->service->store($request);
        alert()->success('ساخت مقام', 'مقام با موفقیت ساخته شد');
        return to_route('roles.index');
    }

    public function edit($id, PermissionRepo $permissionRepo)
    {
//        $this->authorize('index', Role::class);
        $role = $this->repo->findById($id);
        $permissions = $permissionRepo->all();
        return view('Role::edit', compact(['role', 'permissions']));
    }

    public function update(RoleRequest $request, $id)
    {
//        $this->authorize('index', Role::class);
        $this->service->update($request, $id);
        alert()->success('ویرایش مقام', 'مقام با موفقیت ویرایش شد');
        return to_route('roles.index');
    }

    public function destroy($id)
    {
//        $this->authorize('index', Role::class);
        $this->repo->delete($id);
        alert()->success('حذف مقام', 'مقام با موفقیت حذف شد');
        return to_route('roles.index');
    }
}
