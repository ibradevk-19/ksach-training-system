<?php

namespace App\Services;

use App\Models\Application;
use App\Models\Applicant;
use App\Models\Track;
use Illuminate\Support\Facades\DB;

class DashboardAnalyticsService
{
    public function summary(): array
    {
        return [
            'total_applicants' => Applicant::count(),
            'total_applications' => Application::count(),

            'submitted' => Application::where('status', 'submitted')->count(),
            'under_review' => Application::where('status', 'under_review')->count(),
            'accepted' => Application::where('status', 'accepted')->count(),
            'rejected' => Application::where('status', 'rejected')->count(),
            'waiting_list' => Application::where('status', 'waiting_list')->count(),

            'disabled_applicants' => Applicant::where('health_status', 'disabled')->count(),
        ];
    }

    public function applicationsByTrack(): array
    {
        return Application::query()
            ->select('tracks.title', DB::raw('COUNT(applications.id) as total'))
            ->join('tracks', 'tracks.id', '=', 'applications.track_id')
            ->groupBy('tracks.id', 'tracks.title')
            ->orderByDesc('total')
            ->get()
            ->map(fn ($item) => [
                'label' => $item->title,
                'total' => $item->total,
            ])
            ->toArray();
    }

    public function applicationsByStatus(): array
    {
        $statuses = [
            'submitted' => 'مقدم',
            'under_review' => 'قيد المراجعة',
            'accepted' => 'مقبول',
            'rejected' => 'مرفوض',
            'waiting_list' => 'قائمة انتظار',
            'cancelled' => 'ملغي',
        ];

        return Application::query()
            ->select('status', DB::raw('COUNT(*) as total'))
            ->groupBy('status')
            ->get()
            ->map(fn ($item) => [
                'label' => $statuses[$item->status] ?? $item->status,
                'total' => $item->total,
            ])
            ->toArray();
    }

    public function applicantsByGovernorate(): array
    {
        return Applicant::query()
            ->select('governorates.name', DB::raw('COUNT(applicants.id) as total'))
            ->leftJoin('governorates', 'governorates.id', '=', 'applicants.governorate_id')
            ->groupBy('governorates.id', 'governorates.name')
            ->orderByDesc('total')
            ->get()
            ->map(fn ($item) => [
                'label' => $item->name ?? 'غير محدد',
                'total' => $item->total,
            ])
            ->toArray();
    }

    public function applicantsByGender(): array
    {
        return Applicant::query()
            ->select('gender', DB::raw('COUNT(*) as total'))
            ->groupBy('gender')
            ->get()
            ->map(fn ($item) => [
                'label' => $item->gender === 'male' ? 'ذكور' : 'إناث',
                'total' => $item->total,
            ])
            ->toArray();
    }

    public function disabledByTrack(): array
    {
        return Application::query()
            ->select('tracks.title', DB::raw('COUNT(applications.id) as total'))
            ->join('tracks', 'tracks.id', '=', 'applications.track_id')
            ->join('applicants', 'applicants.id', '=', 'applications.applicant_id')
            ->where('applicants.health_status', 'disabled')
            ->groupBy('tracks.id', 'tracks.title')
            ->orderByDesc('total')
            ->get()
            ->map(fn ($item) => [
                'label' => $item->title,
                'total' => $item->total,
            ])
            ->toArray();
    }

    public function topScoredApplications(int $limit = 10)
    {
        return Application::with(['applicant', 'track', 'review'])
            ->orderByDesc('score')
            ->limit($limit)
            ->get();
    }

    public function trackCapacityStats()
    {
        return Track::query()
            ->withCount([
                'applications',
                'applications as accepted_count' => function ($q) {
                    $q->where('status', 'accepted');
                },
                'applications as waiting_count' => function ($q) {
                    $q->where('status', 'waiting_list');
                },
            ])
            ->orderBy('title')
            ->get();
    }
}