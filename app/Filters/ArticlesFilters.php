<?php

namespace App\Filters;

class ArticlesFilters extends Filters
{
    protected $filters = ['is_show', 'category_is_show'];

    protected function is_show($is_show)
    {
        return $this->builder->where('is_show', $is_show);
    }

    protected function category_is_show($is_show)
    {
        return $this->builder->whereHas('category', function ($query) use ($is_show) {
            return $query->where('is_show', $is_show);
        });
    }
}
