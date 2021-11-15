<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\AppController;
use App\Http\Controllers\Controller;
use App\Services\JsonRpcClient;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Collection;

class ActivityController extends AppController
{
    public function activity()
    {
        $visits = $this->getVisits();

        $viewData = [
            'visits' => $visits
        ];
        return view('admin.activity', $viewData);
    }

    /**
     * Get visits with pagination
     * @return LengthAwarePaginator
     */
    private function getVisits()
    {
        $paginationData['count'] = 3;
        $paginationData['page'] = request()->input('page') ?? 1;

        $client = new JsonRpcClient();
        $visits = $client->send('getVisits');

        $visitsCollection = collect($visits['result']);
        return $this->paginate($visitsCollection, $paginationData['count'], $paginationData['page']);
    }

    /**
     * The attributes that are mass assignable.
     * @var array
     */
    public function paginate($items, $perPage, $page = null, $options = [])
    {
        $options['path'] = '/admin/activity';
        $page = $page ?: (Paginator::resolveCurrentPage() ?: 1);
        $items = $items instanceof Collection ? $items : Collection::make($items);
        return new LengthAwarePaginator($items->forPage($page, $perPage), $items->count(), $perPage, $page, $options);
    }
}
