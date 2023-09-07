<?php

namespace Modules\Service\Http\Controllers;

use Illuminate\Http\Request;
use Modules\Service\Http\Requests\ServicesRepairRequest;
use Modules\Service\Http\Requests\ServicesUserRequest;
use Modules\Service\Repositories\ServiceRepo;
use Modules\Service\Services\ServiceServices;
use Modules\Share\Http\Controllers\Controller;

class ServiceController extends Controller
{

    public ServiceRepo $repo;
    public ServiceServices $service;

    public function __construct(ServiceRepo $carRepo, ServiceServices $carService)
    {
        $this->repo = $carRepo;
        $this->service = $carService;
    }

    public function index()
    {
        return view('Service::select');
    }

    public function serviceUser()
    {
        return view('Service::parts.serviceUser');
    }

    public function serviceRepair()
    {
        return view('Service::parts.serviceRepair');
    }

    public function getServiceRepair(ServicesRepairRequest $request)
    {
        $services =  $this->repo->getServiceRepiar($request);
        return view('Service::parts.resRepairs' , compact('services'));
    }

    public function getServiceUser(ServicesUserRequest $request)
    {
        $services =  $this->repo->getServiceUser($request);
        return view('Service::parts.resUsers' , compact('services'));
    }



}
