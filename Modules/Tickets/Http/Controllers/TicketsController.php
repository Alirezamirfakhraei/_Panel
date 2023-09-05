<?php

namespace Modules\Tickets\Http\Controllers;

use Modules\Share\Http\Controllers\Controller;
use Modules\Tickets\Repositories\TicketsRepository;
use Modules\Tickets\Services\TicketsService;

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
        $tickets = $this->repository->currentTicket();
        return view('Tickets::index' , compact('tickets'));
    }

    public function edit($id)
    {
        $ticket = $this->repository->findByID($id);
        return view('Tickets::edit' , compact('ticket'));
    }

    public function showAllTicket()
    {
        $tickets = $this->repository->index();
        return view('Tickets::allTickets' , compact('tickets'));
    }

    public function changeStatus($id)
    {
        $ticket = $this->repository->findByID($id);
        $this->repository->changeStatus($ticket);
        toast('وضعیت دسته بندی با موفقیت تغییر کرد' , 'success');
        return back();
    }
}
