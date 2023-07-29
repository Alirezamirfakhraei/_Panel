<?php

namespace Mlk\Cars\Http\Controllers;

use Mlk\Cars\Repositories\CarRepo;
use Mlk\Cars\Services\CarService;
use Mlk\Share\Http\Controllers\Controller;
class CarsController extends Controller
{

    public CarRepo $repo;
    public CarService $service;

    public function __construct(CarRepo $userRepo, CarService $userService)
    {
        $this->repo = $userRepo;
        $this->service = $userService;
    }
    public function index()
    {
//        $this->authorize('index', User::class);
        $cars = $this->repo->index();
        return view('Cars::index', compact('cars'));
    }
}
