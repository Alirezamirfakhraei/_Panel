<?php

namespace Modules\Tickets\Repositories;

use Illuminate\Support\Facades\DB;
use Modules\Tickets\Models\Ticket;

class TicketsRepository
{
    public function query()
    {
        return DB::connection('mysql_second')->table('tickets');
    }

    public function index()
    {
        return $this->query()->latest()->paginate(15);
    }

    public function findByID($id)
    {
        return $this->query()->where('id' , $id)->first();
    }

    public function currentTicket()
    {
        return $this->query()->where('status' , Ticket::STATUS_NEW)->orWhere('status' , Ticket::STATUS_EXPECTATION)->get()->toArray();
    }

    public function changeStatus($ticket)
    {
        if ($ticket->status == Ticket::STATUS_NEW){
            return $this->query()->where('id' , $ticket->id)->update(['status' => Ticket::STATUS_EXPECTATION]);
        }elseif ($ticket->status == Ticket::STATUS_EXPECTATION){
            return $this->query()->where('id' , $ticket->id)->update(['status' => Ticket::STATUS_END]);
        }
        return [];
    }


}