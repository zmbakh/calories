<?php

namespace App\Http\Controllers\Admin\Report;

use App\Http\Controllers\Controller;
use App\Http\Resources\Report\EntriesAddedResource;
use App\Services\Admin\Report\EntriesAddedService;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    /**
     * @param EntriesAddedService $service
     * @return EntriesAddedResource
     */
    public function entriesAdded(EntriesAddedService $service): EntriesAddedResource
    {
        return new EntriesAddedResource($service->getReport());
    }
}
