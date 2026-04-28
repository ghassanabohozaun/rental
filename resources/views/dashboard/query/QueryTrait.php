<?php

namespace App\Traits;

use Illuminate\Database\Eloquent\Builder;

trait QueryTrait
{
    /**
     * Apply professional search to a query.
     *
     * @param Builder $query
     * @param string|null $searchValue
     * @param array $columns Example: ['name->en', 'name->ar', 'code']
     * @param int $limit
     * @return Builder
     */
    public function applySearch(Builder $query, $searchValue, array $columns, int $limit = 10)
    {
        if (empty($searchValue)) {
            return $query->limit($limit);
        }

        return $query->where(function ($q) use ($searchValue, $columns) {
            foreach ($columns as $column) {
                $q->orWhere($column, 'LIKE', '%' . $searchValue . '%');
            }
        })->limit($limit);
    }

    /**
     * Super Generic Search Method
     *
     * @param string $model Model class name (e.g., Country::class)
     * @param string|null $searchValue The search term
     * @param array $searchColumns Columns to search in (e.g., ['name->en', 'name->ar'])
     * @param array $selectColumns Columns to select (e.g., ['id', 'name->en as text'])
     * @param callable|null $extraConditions Closure for extra query logic (e.g., function($q){ $q->active(); })
     * @param int $limit Number of results
     */
    public function genericSearch($model, $searchValue, array $searchColumns, array $selectColumns = ['*'], ?callable $extraConditions = null, int $limit = 10)
    {
        $query = $model::query()->select($selectColumns);

        if ($extraConditions) {
            $extraConditions($query);
        }

        return $this->applySearch($query, $searchValue, $searchColumns, $limit)->get();
    }
}
