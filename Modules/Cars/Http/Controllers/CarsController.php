<?php

namespace Modules\Cars\Http\Controllers;

use Modules\Cars\Http\Requests\CarRequest;
use Modules\Cars\Repositories\CarRepo;
use Modules\Cars\Services\CarService;
use Modules\Share\Http\Controllers\Controller;
class CarsController extends Controller
{

    public CarRepo $repo;
    public CarService $service;

    public function __construct(CarRepo $carRepo, CarService $carService)
    {
        $this->repo = $carRepo;
        $this->service = $carService;
    }
    public function index()
    {
        $cars = $this->repo->index();
        return view('Cars::index', compact('cars'));
    }

    public function create()
    {
        $categories = $this->repo->findAllCategories();
        $companies = $this->repo->findAllCompany();
        return view('Cars::create' , compact(['categories' , 'companies']));
    }

    public function store(CarRequest $request)
    {
        $this->service->store($request);
        return to_route('cars.index');
    }

    public function edit($id)
    {
        $categories = $this->repo->findAllCategories();
        $companies = $this->repo->findAllCompany();
        $car = $this->repo->findByID($id);
        return view('Cars::edit' , compact(['car' , 'categories' , 'companies']));
    }

    public function update(CarRequest $request , $id)
    {
        $this->service->update($request , $id);
        return to_route('cars.index');
    }

    public function detail($id)
    {
        $details = $this->repo->findByID($id);
        return view('Cars::index', compact('details'));
    }

    public function destroy($id)
    {
//        $this->authorize('index', User::class);
        $this->service->delete($id);
        return to_route('cars.index');
    }


}
