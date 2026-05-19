<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Application;
use App\Models\Track;
use App\Services\ApplicationReviewService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TrackRankingController extends Controller
{
    public function index(Request $request)
    {
        $tracks = Track::orderBy('title')->get();

        $selectedTrack = null;
        $applications = collect();

        if ($request->filled('track_id')) {
            $selectedTrack = Track::findOrFail($request->track_id);

            $applications = Application::with([
                    'applicant',
                    'track',
                    'review',
                ])
                ->where('track_id', $selectedTrack->id)
                ->orderByDesc('score')
                ->paginate(50)
                ->withQueryString();
        }

        return view('admin.rankings.index', compact(
            'tracks',
            'selectedTrack',
            'applications'
        ));
    }

    public function analyzeAll(Request $request, ApplicationReviewService $service)
    {
        $request->validate([
            'track_id' => 'required|exists:tracks,id',
        ]);

        $applications = Application::where('track_id', $request->track_id)
            ->with(['applicant', 'track', 'answers.field'])
            ->get();

        foreach ($applications as $application) {
            $service->analyze($application);
        }

        return back()->with('success', 'تم تحليل جميع طلبات المسار بنجاح');
    }

    public function autoSelect(Request $request)
    {
        $request->validate([
            'track_id' => 'required|exists:tracks,id',
        ]);

        $track = Track::findOrFail($request->track_id);

        DB::transaction(function () use ($track) {

            $eligibleApplications = Application::with('review')
                ->where('track_id', $track->id)
                ->whereHas('review', function ($q) {
                    $q->where('eligibility_status', 'eligible');
                })
                ->orderByDesc('score')
                ->get();

            $acceptedIds = $eligibleApplications
                ->take($track->seats)
                ->pluck('id')
                ->toArray();

            $waitingIds = $eligibleApplications
                ->skip($track->seats)
                ->pluck('id')
                ->toArray();

            Application::where('track_id', $track->id)
                ->whereHas('review', function ($q) {
                    $q->where('eligibility_status', 'not_eligible');
                })
                ->update(['status' => 'rejected']);

            if (!empty($acceptedIds)) {
                Application::whereIn('id', $acceptedIds)
                    ->update(['status' => 'accepted']);
            }

            if (!empty($waitingIds)) {
                Application::whereIn('id', $waitingIds)
                    ->update(['status' => 'waiting_list']);
            }
        });

        return back()->with('success', 'تم اعتماد المرشحين حسب عدد المقاعد ونقل الباقي لقائمة الانتظار');
    }

    public function rejectNotEligible(Request $request)
    {
        $request->validate([
            'track_id' => 'required|exists:tracks,id',
        ]);

        Application::where('track_id', $request->track_id)
            ->whereHas('review', function ($q) {
                $q->where('eligibility_status', 'not_eligible');
            })
            ->update(['status' => 'rejected']);

        return back()->with('success', 'تم رفض جميع الطلبات غير المؤهلة');
    }
}