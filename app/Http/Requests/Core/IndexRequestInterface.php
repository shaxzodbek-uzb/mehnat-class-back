<?php

namespace App\Http\Requests\Core;
use Illuminate\Validation\Rule;

interface IndexRequestInterface
{
    const DEFAULT_INDEX_RULES = [
        'include' => 'string',
        //sort
        /*
            'sort' => [
                [
                    'key' => 'id'
                    'type' => 'desc'
                ]
            ]
        */
        'sort' => 'nullable|array',
        'sort.*.key' => 'required_with:sort',
        'sort.*.type' => 'required_with:sort|in:ans,desc',

        //filter
        /*
            'filter' => [
                [
                    'key' => 'id'
                    'type' => 'equal' {equal, like, in, between, greater}
                    'value' => 12
                ]
            ]
        */

        'filter' => 'nullable|array',
        'filter.*.key' => 'required_with:filter',
        'filter.*.type' => 'required_with:filter|in:equal,like,in,between,greater',
        'filter.*.value' => 'required_with:filter',

        //paginate
        /*
            'pagination' => [
                'page' => 1,
                'per_page' => 10
            ]
        */

        'pagination' => 'nullable|array',
        'pagination.page' => 'nullable|numeric',
        'pagination.per_page' => 'nullable|numeric'
    ];
}
