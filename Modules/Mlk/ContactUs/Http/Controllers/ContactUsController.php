<?php

namespace Mlk\ContactUs\Http\Controllers;

use Illuminate\Http\Request;
use Mlk\ContactUs\Repositories\ContactUsRepository;
use Mlk\ContactUs\Services\ContactUsService;
use Mlk\Share\Http\Controllers\Controller;

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


    public function store(Request $request)
    {
        return $this->service->store($request);
    }
}
