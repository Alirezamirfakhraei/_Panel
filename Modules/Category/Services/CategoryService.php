<?php

namespace Modules\Category\Services;

use Illuminate\Support\Facades\DB;
use Modules\Category\Models\Category;

class CategoryService
{

    private function query()
    {
        return DB::connection('mysql_second')->table("categories");
    }


    public function store($request)
    {
        return $this->query()->insert([
            'parentID' => $request->parentID,
            'title' => $request->title,
            'slug' => $this->makeSlug($request->title),
            'keywords' => $request->keywords,
            'description' => $request->description,
            'status' => $request->status,
        ]);
    }

    public function update($request, $id)
    {
        return $this->query()->whereId($id)->update([
            'parentID' => $request->parentID,
            'title' => $request->title,
            'slug' => $this->makeSlug($request->title),
            'keywords' => $request->keywords,
            'description' => $request->description,
            'status' => $request->status,
        ]);
    }

    private function makeSlug($title)
    {
        $url = str_replace('_', '', $title);
        return preg_replace('/\s+/', '-', $url);
    }
}
