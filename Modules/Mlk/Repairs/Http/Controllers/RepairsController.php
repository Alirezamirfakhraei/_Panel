<?php

namespace Mlk\Repairs\Http\Controllers;

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
}
