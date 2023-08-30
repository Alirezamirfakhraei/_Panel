<?php

namespace Modules\Cars\Services;

use Functions;
use helper;
use Illuminate\Support\Facades\DB;

class CarService
{
    private function query()
    {
        return DB::connection('mysql_second')->table('cars');
    }

    private function generateCarId($codeLength, $mode = null)
    {
        $characters = '0123456789';
        $charactersLength = strlen($characters);
        $randomString = '';
        if ($mode == 'customer') {
            $randomString .= "IRI";
            for ($i = 3; $i < $codeLength; $i++) {
                $randomString .= $characters[rand(0, $charactersLength - 1)];
            }
        } else {
            for ($i = 0; $i < $codeLength; $i++) {
                $randomString .= $characters[rand(0, $charactersLength - 1)];
            }
        }
        if ($this->query()->where('carID', $randomString)->exists()) {
            return $randomString . '1';
        }
        return $randomString;
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
        $function = new Functions();
        $characterPlate = $function->validatePlate($request->plate[2]);
        $newPlate = $request->plate[1].$characterPlate.$request->plate[3].$request->plate[4];
        $findPlate = DB::connection('mysql_second')->table('cars')->where('plate', $newPlate)->first();
        if ($findPlate) {
            return to_route('cars.create')->with(['danger_message' => helper::DuplicatePlate]);
        }
        $category = DB::connection('mysql_second')->table('categories')->where('id', $request['company'])->first();
        if (!$category){
            return to_route('cars.create')->with(['danger_message' => helper::CarNotFound]);
        }
        $insert = $this->query()->insert([
            'userCreated' => $request['userID'],
            'userID' => $request['userID'],
            'categoryID' => $category->id,
            'carID' => $this->generateCarId(9 , ''),
            'company' => $request['company'],
            'model' => $request['model'],
            'year' => $request['year'],
            'plate' => $newPlate,
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

    public function update($request , $id)
    {
        $function = new Functions();
        $characterPlate = $function->validatePlate($request->plate[2]);
        $newPlate = $request->plate[1].$characterPlate.$request->plate[3].$request->plate[4];
        $findPlate = DB::connection('mysql_second')->table('cars')->where('plate', $newPlate)->first();
        if ($findPlate) {
            return to_route('cars.create')->with(['danger_message' => helper::DuplicatePlate]);
        }
        $category = DB::connection('mysql_second')->table('categories')->where('id', $request['company'])->first();
        if (!$category){
            return to_route('cars.create')->with(['danger_message' => helper::CarNotFound]);
        }
        $update = $this->query()->where('id' , $id)->update([
            'userCreated' => auth()->id(),
            'userID' => $request['userID'],
            'categoryID' => $category->id,
            'carID' => $this->generateCarId(9 , ''),
            'company' => $request['company'],
            'model' => $request['model'],
            'year' => $request['year'],
            'plate' => $newPlate,
            'third_insurance' => $request['third_insurance'],
            'km_average' => self::calculateKmAverage($request['km_current'], ["year" => $request['year'], "third_insurance" => $request['third_insurance']]),
            'km_at' => $request['km_current'],
            'km_current' => $request['km_current'],
            'chassis_number' => $request['chassis_number'],
            'engine_number' => $request['engine_number'],
            'pin' => 0,
        ]);
        if ($update){
            toast(helper::SubmitRequest, 'success');
        }else{
            toast(helper::NotInsertNewRecorde, 'danger');
        }
        return to_route('cars.index');
    }

    public function delete($id)
    {
        toast(helper::SubmitRequest, 'success');
        return $this->query()->where('id', $id)->delete();
    }

}