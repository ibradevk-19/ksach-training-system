<?php

namespace App\Http\Controllers\Admin;

use App\Exports\ApplicationsReportExport;
use App\Http\Controllers\Controller;
use App\Models\Application;
use App\Models\Track;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class ApplicationReportController extends Controller
{
    public function index(Request $request)
    {
        $tracks = Track::orderBy('title')->get();

        $query = $this->buildQuery($request);

        $applications = $query->paginate(25)->withQueryString();

        $summary = [
            'total' => (clone $this->buildQuery($request))->count(),
            'accepted' => (clone $this->buildQuery($request))->where('status', 'accepted')->count(),
            'waiting_list' => (clone $this->buildQuery($request))->where('status', 'waiting_list')->count(),
            'rejected' => (clone $this->buildQuery($request))->where('status', 'rejected')->count(),
        ];

        return view('admin.reports.applications.index', compact(
            'applications',
            'tracks',
            'summary'
        ));
    }

    public function exportExcel(Request $request)
    {
        return Excel::download(
            new ApplicationsReportExport($request),
            'applications-report-' . now()->format('Y-m-d') . '.xlsx'
        );
    }

    public function exportPdf(Request $request)
    {
        $applications = $this->buildQuery($request)->get();

        $summary = [
            'total' => $applications->count(),
            'accepted' => $applications->where('status', 'accepted')->count(),
            'waiting_list' => $applications->where('status', 'waiting_list')->count(),
            'rejected' => $applications->where('status', 'rejected')->count(),
        ];

        $pdf = Pdf::loadView('admin.reports.applications.pdf', [
            'applications' => $applications,
            'summary' => $summary,
            'filters' => $request->all(),
        ])->setPaper('a4', 'landscape');

        return $pdf->download('applications-report-' . now()->format('Y-m-d') . '.pdf');
    }

    private function buildQuery(Request $request)
    {
        $query = Application::with([
            'applicant.governorate',
            'applicant.populationCommunity',
            'track',
            'review',
        ])->latest();

        if ($request->filled('track_id')) {
            $query->where('track_id', $request->track_id);
        }

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        if ($request->filled('eligibility_status')) {
            $query->whereHas('review', function ($q) use ($request) {
                $q->where('eligibility_status', $request->eligibility_status);
            });
        }

        if ($request->filled('gender')) {
            $query->whereHas('applicant', function ($q) use ($request) {
                $q->where('gender', $request->gender);
            });
        }

        if ($request->filled('governorate_id')) {
            $query->whereHas('applicant', function ($q) use ($request) {
                $q->where('governorate_id', $request->governorate_id);
            });
        }

        if ($request->filled('q')) {
            $query->where(function ($q) use ($request) {
                $q->where('application_number', 'like', '%' . $request->q . '%')
                    ->orWhereHas('applicant', function ($applicantQuery) use ($request) {
                        $applicantQuery->where('full_name', 'like', '%' . $request->q . '%')
                            ->orWhere('national_id', 'like', '%' . $request->q . '%')
                            ->orWhere('phone_1', 'like', '%' . $request->q . '%');
                    });
            });
        }

        return $query;
    }
}
