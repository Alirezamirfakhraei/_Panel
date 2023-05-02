<?php

namespace Modules\Cars\Http\Controllers\V1;

use Illuminate\Routing\Controller;
use Modules\Cars\Repositoreis\CarRepositories;
use Modules\Cars\Services\CarServices;

class CarsController extends Controller
{

    public CarRepositories $repositories;
    public CarServices $services;

    public function __construct(CarRepositories $repositories , CarServices $services)
    {
        $this->middleware('auth:api', ['except' => ['login', 'register']]);
        $this->repositories = $repositories;
        $this->services = $services;
    }

    public function cars()
    {
        return $this->repositories->cars();
    }

    public function addCar()
    {

    }

    public function editCar()
    {

    }

    public function deleteCar()
    {

    }

    public function findCar()
    {

    }

    public function findPlateCar()
    {

    }


}
