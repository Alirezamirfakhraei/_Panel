<?php

namespace Mlk\Category\Repositories;

use Illuminate\Support\Facades\DB;
use Mlk\Category\Models\Category;

class CategoryRepo
{

    private function query()
    {
        return DB::connection('mysql_second')->table("categories");
    }

    public function index()
    {
        return DB::connection('mysql_second')->table("categories")->latest()->paginate(20);
    }

    public function findById($id)
    {
        return $this->query()->findOrFail($id);
    }

    public function delete($id)
    {
        return $this->query()->where('id', $id)->delete();
    }

    public function changeStatus($category)
    {
        if ($category->status === Category::STATUS_ACTIVE) {
            return $category->update(['status' => Category::STATUS_INACTIVE]);
        }
        return $category->update(['status' => Category::STATUS_ACTIVE]);
    }

    // Home Query
    public function getActiveCategories()
    {
        return $this->query()->where('status', Category::STATUS_ACTIVE)->latest();
    }

    public function findBySlug($slug)
    {
        return $this->query()->where('status', Category::STATUS_ACTIVE)->whereSlug($slug)->first();
    }
}
