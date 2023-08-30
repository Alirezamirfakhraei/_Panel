<?php

namespace Modules\Category\Http\Controllers\Home;

use Modules\Article\Repositories\ArticleRepo;
use Modules\Category\Repositories\CategoryRepo;
use Modules\Share\Http\Controllers\Controller;

class CategoryController extends Controller
{
    public function details($slug, CategoryRepo $categoryRepo, ArticleRepo $articleRepo)
    {
        $category = $categoryRepo->findBySlug($slug);

        if (is_null($category)) abort(404);

        $articles = $articleRepo->getarticlesByCategoryId($category->id)->paginate(12);

        return view('Category::Home.details', compact(['category', 'articles']));
    }
}
