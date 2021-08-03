<?php

namespace Rapidez\MirasvitKnowledgeBase\Models;

use Rapidez\Core\Models\Model;
use Rapidez\Core\Models\Scopes\IsActiveScope;

class Category extends Model
{
    protected $table = 'mst_kb_category';

    protected $primaryKey = 'category_id';

    protected static function booted()
    {
        static::addGlobalScope(new IsActiveScope());
    }

    public function subCategories()
    {
        return $this->hasMany(__CLASS__, 'parent_id', 'category_id');
    }

    public function articles()
    {
        return $this->belongsToMany(Article::class, 'mst_kb_article_category', 'ac_category_id', 'ac_article_id');
    }

    public static function getRootCategory()
    {
        return self::query()
            ->join('mst_kb_category_store', 'mst_kb_category_store.as_category_id', '=', 'mst_kb_category.category_id')
            ->where('parent_id', 1)
            ->whereIn('as_store_id', [0, config('rapidez.store')])
            ->orderByDesc('as_store_id')
            ->first();
    }
}
