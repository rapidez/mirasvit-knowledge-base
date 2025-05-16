<?php

use Illuminate\Support\Facades\Route;
use Rapidez\Core\Facades\Rapidez;
use Rapidez\MirasvitKnowledgeBase\Models\Article;
use Rapidez\MirasvitKnowledgeBase\Models\Category;
use Rapidez\MirasvitKnowledgeBase\Models\Rewrite;

try {
    $prefix = Rapidez::config('kb/general/base_url', 'knowledge-base');
} catch (\Exception $e) {
    $prefix = 'knowledge-base';
}

Route::middleware('web')->prefix($prefix)->group(function () {
    Route::get('/{slug}', function ($slug) {
        $rewrite = Rewrite::where('url_key', $slug)->firstOrFail();

        if ($rewrite->type == 'CATEGORY') {
            $category = Category::findOrFail($rewrite->entity_id);
            $categories = Category::with('subCategories')
                ->orderBy('position')
                ->where('parent_id', $category->category_id)
                ->get();
            $articles = $category->articles()->paginate(10);

            return view('mirasvitknowledgebase::category', compact('category', 'categories', 'articles'));
        }

        if ($rewrite->type == 'ARTICLE') {
            $article = Article::findOrFail($rewrite->entity_id);

            return view('mirasvitknowledgebase::article', compact('article'));
        }

        abort(404);
    })->name('knowledgebase')->where('slug', '.*');

    Route::get('', function () {
        $category = Category::getRootCategory();
        $categories = Category::with(['subCategories', 'articles'])
            ->orderBy('position')
            ->where('parent_id', $category->category_id)
            ->get();

        return view('mirasvitknowledgebase::category', compact('category', 'categories'));
    });
});
