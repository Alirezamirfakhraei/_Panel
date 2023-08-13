<?php

namespace Mlk\Cars\Services;

use helper;
use Illuminate\Support\Facades\DB;
use Mlk\Cars\Models\Cars;

class CarService
{
    private function query()
    {
        return DB::connection('mysql_second')->table('cars');
    }

    private function calculateKmAverage($km, $item)
    {
        if (isset($km)) {
            $year = $item['year'];
            $month = explode("-", $item['third_insurance']);
            $day = explode("-", $item['third_insurance']);
            if (($month[1] > 11) || ($month[1] == 11 && $day[2] >= 22)) {
                $year = $year - 1;
            }
            $newDate = date_create(now());
            $shamsiDate = date_create(jdate($newDate)->format('Y-m-d '));
            $oldDate = $year . "-" . $month[1] . "-" . $day[2];
            $res = date_create(json_decode(json_encode($oldDate)));
            $interval = date_diff($res, $shamsiDate);
            $countYear = (int)$interval->format('%y year');
            $countMonth = (int)$interval->format('%m month');
            $countDay = (int)$interval->format('%d day');
            if ($countMonth != null) {
                $average = $km / (($countYear * 12) + $countMonth + ($countDay / 30));
                $result = ceil($average / 100) * 100;
            } else {
                $result = 0;
            }
            return $result;
        }
        return [];
    }


    public function store($request)
    {
        $plate = $request->plate[1].$request->plate[2].$request->plate[3].$request->plate[4];
        dd($plate);
        $help = new helper();
        $findPlate = DB::connection('mysql_second')->table('cars')->where('plate', $plate)->first();
        dd($plate,$findPlate);
        if ($findPlate) {
            return to_route('cars.create')->with(['danger_message' => helper::DuplicatePlate]);
        }
        dd($plate , $request->model , $request->company);
        $category = DB::connection('mysql_second')->table('categories')->where('title', $request['company'])->first();
        if (!$category){
            return $help->response('CategoryNotFound', 400, null, helper::CategoryNotFound);
        }
        $check_1 = $help->CheckDate(null, $request['year'], "year", '');
        if ($check_1['error']) {
            return $help->response('Wrong', 400, null, helper::WrongYearForCar);
        }
        $insert = $this->query()->insert([
            'userCreated' => $request['userID'],
            'userID' => $request['userID'],
            'categoryID' => $category['id'],
            'carID' => Cars::generateCarId(16),
            'company' => $request['company'],
            'model' => $request['model'],
            'year' => $request['year'],
            'plate' => $request['plate'],
            'third_insurance' => $request['third_insurance'],
            'km_lastReplace' => $request['km_lastReplace'],
            'km_average' => self::calculateKmAverage($request['km_current'], ["year" => $request['year'], "third_insurance" => $request['third_insurance']]),
            'km_at' => $request['km_current'],
            'km_current' => $request['km_current'],
            'pin' => 0,
        ]);
        if ($insert){
            toast(helper::SubmitRequest, 'success');
        }else{
            toast(helper::NotInsertNewRecorde, 'danger');
        }
        return to_route('cars.index');
    }

}