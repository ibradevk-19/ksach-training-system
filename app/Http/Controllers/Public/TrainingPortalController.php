<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Models\Governorate;
use App\Models\IncomeType;
use App\Models\ResidenceType;
use App\Models\Track;
use App\Services\PublicPortal\PublicApplicationService;
use Illuminate\Http\Request;

class TrainingPortalController extends Controller
{
    public function index()
    {
        $tracks = Track::with(['type', 'category'])
            ->where('status', 'published')
            ->latest()
            ->get();

        return view('public.tracks.index', compact('tracks'));
    }

    public function show(Track $track)
    {
        abort_if($track->status !== 'published', 404);

        $track->load(['type', 'category', 'form.sections.fields']);

        return view('public.tracks.show', compact('track'));
    }

    public function apply(Track $track)
    {
        abort_if($track->status !== 'published', 404);

        $track->load('form.sections.fields');

        if (!$track->form) {
            return redirect()
                ->route('public.tracks.show', $track)
                ->with('error', 'لا يوجد نموذج متاح لهذا المسار حالياً.');
        }

        return view('public.applications.apply', [
            'track' => $track,
            'form' => $track->form,
            'governorates' => Governorate::where('status', true)->get(),
            'residenceTypes' => ResidenceType::where('status', true)->get(),
            'incomeTypes' => IncomeType::where('status', true)->get(),
        ]);
    }

    public function submit(Request $request, Track $track, PublicApplicationService $service)
    {
        abort_if($track->status !== 'published', 404);

        $track->load('form.fields');

        $rules = $this->validationRules($track);

        $request->validate($rules);

        $application = $service->submit($request, $track);

        return redirect()
            ->route('public.applications.success', $application)
            ->with('success', 'تم إرسال طلبك بنجاح');
    }

    public function success($application)
    {
        $application = \App\Models\Application::with(['applicant', 'track'])
            ->where('id', $application)
            ->firstOrFail();

        return view('public.applications.success', compact('application'));
    }

    private function validationRules(Track $track): array
    {
        $rules = [
            'full_name' => 'required|string|max:255',
            'national_id' => 'required|string|max:20',
            'phone_1' => 'required|string|max:20',
            'phone_2' => 'nullable|string|max:20',
            'gender' => 'required|in:male,female',
            'birth_date' => 'nullable|date',
            'governorate_id' => 'nullable|exists:governorates,id',
            'displacement_status' => 'nullable|in:resident,displaced',
            'residence_type_id' => 'nullable|exists:residence_types,id',
            'current_address' => 'nullable|string',
            'family_members_count' => 'nullable|integer|min:0|max:100',
            'breadwinner_status' => 'nullable|in:husband,widow,divorced,other',
            'employment_status' => 'nullable|in:employed,unemployed',
            'income_type_id' => 'nullable|exists:income_types,id',
            'education_level' => 'nullable|in:none,preparatory,secondary,bachelor,master_or_above',
            'specialization' => 'nullable|string|max:255',
            'health_status' => 'nullable|in:healthy,disabled',
        ];

        foreach ($track->form?->fields()->where('status', true)->get() ?? [] as $field) {

                if (in_array($field->name, $this->skippedDynamicFields())) {
                    continue;
                }

                $fieldRules = [];

                $fieldRules[] = $field->is_required ? 'required' : 'nullable';

                if ($field->type === 'file') {
                    $fieldRules[] = 'file';
                    $fieldRules[] = 'mimes:jpg,jpeg,png,pdf';
                    $fieldRules[] = 'max:5120';
                }

                if ($field->validation_rules) {
                    $fieldRules[] = $field->validation_rules;
                }

                $rules['answers.' . $field->id] = implode('|', $fieldRules);
        }

        return $rules;
    }

    private function skippedDynamicFields(): array
    {
        return [
            'full_name',
            'national_id',
            'phone_1',
            'phone_2',
            'gender',
            'age_group',

            'governorate',
            'displacement_status',
            'residence_type',
            'current_address',
            'family_members_count',
            'breadwinner_status',

            'employment_status',
            'monthly_income',
            'education_level',
            'specialization',
            'health_status',

            'identity_image',
            'medical_report',
            'education_certificate',
        ];
    }


    public function landing()
{
    $tracks = \App\Models\Track::with(['type', 'category'])
        ->where('status', 'published')
        ->latest()
        ->take(8)
        ->get();

    $stats = [
        'tracks_count' => \App\Models\Track::where('status', 'published')->count(),
        'total_seats' => \App\Models\Track::where('status', 'published')->sum('seats'),
        'applications_count' => \App\Models\Application::count(),
        'accepted_count' => \App\Models\Application::where('status', 'accepted')->count(),
    ];

    return view('public.landing', compact('tracks', 'stats'));
}
}