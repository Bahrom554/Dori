<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use Illuminate\Http\Request;
use Spatie\QueryBuilder\AllowedFilter;
use Spatie\QueryBuilder\QueryBuilder;

class SettingController extends Controller
{


    public function index(Request $request)
    {

        $filters = $request->get('filter');
        $filter = [];
        if (!empty($filters)) {
            foreach ($filters as $k => $item) {
                $filter[] = AllowedFilter::exact($k);
            }
        }
        $query = QueryBuilder::for(Setting::class);
        if (!empty($request->get('search'))) {
            $query->where('name', 'like', '%' . $request->get('search') . '%');
        }
        $query->allowedFilters($filter);
        $query->allowedSorts($request->sort);
        return $query->paginate(20);
    }

}
