<?php

namespace Modules\Cars\Repositoreis;

use Illuminate\Support\Facades\DB;


class CarRepositories
{

    private function query()
    {
        return DB::connection('mysql2')->table('cars')->get()->all();
    }

    public function cars()
    {
        $cars = $this->query();
        $arrayCars = [];
        for ($i = 0; $i < count($this->query()); $i++)
        {
            $arrayCars[$i] = [
                'userID' => $cars[$i]->userID,
                'carID' => $cars[$i]->carID,
                'company' => $cars[$i]->company,
                'model' => $cars[$i]->model,
                'plate' => $cars[$i]->plate,
            ];
        }
          return  $arrayCars ?: ['check' => false];
    }
}
