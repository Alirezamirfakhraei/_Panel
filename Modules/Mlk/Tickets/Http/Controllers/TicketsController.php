<?php

namespace Mlk\Tickets\Http\Controllers;

use Mlk\Share\Http\Controllers\Controller;
use Mlk\Tickets\Repositories\TicketsRepository;
use Mlk\Tickets\Services\TicketsService;

class TicketsController extends Controller
{
    public TicketsRepository $repository;
    public TicketsService $service;

    public function __construct(TicketsRepository $repository  , TicketsService $service)
    {
        $this->repository = $repository;
        $this->service = $service;
    }

    public function index()
    {
        $tickets = $this->repository->index();
        return view('Tickets::index' , compact('tickets'));
    }






}
