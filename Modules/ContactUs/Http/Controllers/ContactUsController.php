<?php

namespace Modules\ContactUs\Http\Controllers;

use Illuminate\Http\Request;
use Modules\ContactUs\Repositories\ContactUsRepository;
use Modules\ContactUs\Services\ContactUsService;
use Modules\Share\Http\Controllers\Controller;

class ContactUsController extends Controller
{
    public ContactUsRepository $repository;
    public ContactUsService $service;

    public function __construct(ContactUsRepository $repository  , ContactUsService $service)
    {
        $this->repository = $repository;
        $this->service = $service;
    }

    public function index()
    {
        $messages = $this->repository->index();
        return view('ContactUs::index' , compact('messages'));
    }

    public function changeStatus($id)
    {
        $message = $this->repository->findById($id);
        $this->repository->changeStatus($message);

    }


    public function store(Request $request)
    {
        return $this->service->store($request);
    }




}
