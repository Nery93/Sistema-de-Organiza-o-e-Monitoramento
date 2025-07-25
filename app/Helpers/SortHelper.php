<?php

namespace App\Helpers;

use Illuminate\Support\Arr;

class SortHelper
{
    public static function generateSortData($currentSort, $currentDirection, $routeName = 'produto.index', $columns = [])
    {
        
        $currentQuery = request()->query();
        $sort = [];
        $columns = ['sku', 'ean', 'un', 'categoria', 'descrição', 'diferença_stock'];

        foreach ($columns as $column) {
            $queryParams = $currentQuery;

            if ($currentSort === $column && $currentDirection === 'asc') {
                $queryParams['sort'] = $column;
                $queryParams['direction'] = 'desc';
            } elseif ($currentSort === $column && $currentDirection === 'desc') {
                unset($queryParams['sort']);
                unset($queryParams['direction']);
            } else {
                $queryParams['sort'] = $column;
                $queryParams['direction'] = 'asc';
            }

            $url = route($routeName, array_filter([
                'sort' => $queryParams['sort'] ?? null,
                'direction' => $queryParams['direction'] ?? null
            ])) . '?' . http_build_query(Arr::except($queryParams, ['sort', 'direction']));

            $sort[$column] = $url;
        }

        $mapDir = [
            'asc' => 'fa-sort-up',
            'desc' => 'fa-sort-down',
            '' => 'fa-sort'
        ];

        return [
            'sortColumn' => $currentSort,
            'sortDirection' => $currentDirection,
            'sort' => $sort,
            'mapDir' => $mapDir,
        ];
    }
}
