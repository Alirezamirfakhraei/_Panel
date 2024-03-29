<?php

namespace Modules\Repairs\Http\Controllers;

use Illuminate\Http\Request;
use Modules\Repairs\Http\Requests\AddRepairRequest;
use Modules\Repairs\Repositories\RepairRepo;
use Modules\Repairs\Services\RepairService;
use Modules\Share\Http\Controllers\Controller;

class RepairsController extends Controller
{

    public RepairRepo $repo;
    public RepairService $service;

    public function __construct(RepairRepo $repairRepo, RepairService $repairService)
    {
        $this->repo = $repairRepo;
        $this->service = $repairService;
    }
    public function index()
    {
        $repairs = $this->repo->index();
        return view('Repairs::index', compact('repairs'));
    }

    public function create()
    {
        return view('Repairs::create');
    }

    public function store(AddRepairRequest $request)
    {
        return $this->service->store($request);
    }

    public function edit($id)
    {
        $repair = $this->repo->findById($id);
        return view('Repairs::edit' , compact('repair'));
    }

    public function update(AddRepairRequest $request , $id)
    {
        $this->service->update($request , $id);
        return to_route('repairs.index');
    }

    public function destroy($id)
    {
        $this->service->delete($id);
        return to_route('repairs.index');
    }
}
