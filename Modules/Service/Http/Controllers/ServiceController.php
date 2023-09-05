<?php

namespace Modules\Service\Http\Controllers;

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

    }




}
