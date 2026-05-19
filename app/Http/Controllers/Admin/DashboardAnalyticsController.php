<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Services\DashboardAnalyticsService;
use Illuminate\Http\Request;
use App\Models\Application;
use App\Models\Applicant;
use App\Models\Track;
use Illuminate\Support\Facades\DB;

class DashboardAnalyticsController extends Controller
{
    public function index(DashboardAnalyticsService $service)
    {
        return view('admin.dashboard.analytics', [
            'summary' => $service->summary(),
            'applicationsByTrack' => $service->applicationsByTrack(),
            'applicationsByStatus' => $service->applicationsByStatus(),
            'applicantsByGovernorate' => $service->applicantsByGovernorate(),
            'applicantsByGender' => $service->applicantsByGender(),
            'disabledByTrack' => $service->disabledByTrack(),
            'topScoredApplications' => $service->topScoredApplications(),
            'trackCapacityStats' => $service->trackCapacityStats(),
        ]);
    }
}