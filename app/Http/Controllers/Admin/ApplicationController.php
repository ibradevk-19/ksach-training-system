<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Application;
use App\Models\Applicant;
use App\Models\Track;
use App\Services\ApplicationService;
use Illuminate\Http\Request;

class ApplicationController extends Controller
{
    public function index(Request $request)
    {
        $query = Application::with([
            'applicant',
            'track',
            'creator',
            'reviewer',
        ])->latest();

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

        if ($request->filled('track_id')) {
            $query->where('track_id', $request->track_id);
        }

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        if ($request->filled('gender')) {
            $query->whereHas('applicant', function ($q) use ($request) {
                $q->where('gender', $request->gender);
            });
        }

        $items = $query->paginate(15)->withQueryString();

        $tracks = Track::orderBy('title')->get();

        return view('admin.applications.index', compact('items', 'tracks'));
    }

    public function create()
    {
        $applicants = Applicant::where('is_active', true)
            ->orderBy('full_name')
            ->get();

        $tracks = Track::where('status', 'published')
            ->orderBy('title')
            ->get();

        return view('admin.applications.create', compact('applicants', 'tracks'));
    }

    public function store(Request $request, ApplicationService $service)
    {
        $request->validate([
            'applicant_id' => 'required|exists:applicants,id',
            'track_id' => 'required|exists:tracks,id',
            'notes' => 'nullable|string',
        ]);

        $applicant = Applicant::findOrFail($request->applicant_id);
        $track = Track::findOrFail($request->track_id);

        $service->createApplication($applicant, $track, [
            'notes' => $request->notes,
        ]);

        return redirect()
            ->route('admin.applications.index')
            ->with('success', 'تم إنشاء الطلب بنجاح');
    }

    public function show(Application $application)
    {
        $application->load([
            'applicant.governorate',
            'applicant.residenceType',
            'applicant.incomeType',
            'track.type',
            'track.category',
            'creator',
            'reviewer',
        ]);

        return view('admin.applications.show', compact('application'));
    }

    public function edit(Application $application)
    {
        $tracks = Track::orderBy('title')->get();

        return view('admin.applications.edit', compact('application', 'tracks'));
    }

    public function update(Request $request, Application $application)
    {
        $request->validate([
            'status' => 'required|in:draft,submitted,under_review,accepted,rejected,waiting_list,cancelled',
            'score' => 'required|integer|min:0|max:100',
            'notes' => 'nullable|string',
        ]);

        $application->update([
            'status' => $request->status,
            'score' => $request->score,
            'notes' => $request->notes,
        ]);

        return redirect()
            ->route('admin.applications.index')
            ->with('success', 'تم تحديث الطلب بنجاح');
    }

    public function destroy(Application $application)
    {
        $application->delete();

        return back()->with('success', 'تم حذف الطلب');
    }

    public function changeStatus(Request $request, Application $application, ApplicationService $service)
    {
        $request->validate([
            'status' => 'required|in:draft,submitted,under_review,accepted,rejected,waiting_list,cancelled',
            'notes' => 'nullable|string',
        ]);

        $service->updateStatus($application, $request->status, $request->notes);

        return back()->with('success', 'تم تحديث حالة الطلب');
    }
}
