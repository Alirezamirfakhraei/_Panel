<?php

namespace Mlk\Repairs\Http\Controllers;

use Mlk\Repairs\Http\Requests\AddRepairRequest;
use Mlk\Repairs\Repositories\RepairRepo;
use Mlk\Repairs\Services\RepairService;
use Mlk\Share\Http\Controllers\Controller;

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

    public function destroy($id)
    {
        $this->service->delete($id);
        return to_route('repairs.index');
    }
}
