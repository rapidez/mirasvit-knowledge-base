<?php

namespace Rapidez\MirasvitKnowledgeBase\Models;

use Rapidez\Core\Models\Model;
use Rapidez\Core\Models\Scopes\IsActiveScope;

class Article extends Model
{
    protected $table = 'mst_kb_article';

    protected $primaryKey = 'article_id';

    protected static function booted()
    {
        static::addGlobalScope(new IsActiveScope);
    }
}
