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

        $request->validate(
            $rules,
            $this->validationMessages(),
            $this->validationAttributes($track)
        );

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

    private function validationMessages(): array
    {
        return [
            'required' => 'حقل :attribute مطلوب.',
            'string' => 'حقل :attribute يجب أن يكون نصاً.',
            'integer' => 'حقل :attribute يجب أن يكون رقماً صحيحاً.',
            'numeric' => 'حقل :attribute يجب أن يكون رقماً.',
            'date' => 'حقل :attribute يجب أن يكون تاريخاً صحيحاً.',
            'email' => 'حقل :attribute يجب أن يكون بريداً إلكترونياً صحيحاً.',
            'boolean' => 'حقل :attribute يجب أن يكون صحيحاً أو خطأ.',
            'array' => 'حقل :attribute يجب أن يحتوي على قائمة اختيارات.',
            'file' => 'حقل :attribute يجب أن يكون ملفاً.',
            'mimes' => 'حقل :attribute يجب أن يكون من نوع: :values.',
            'max.string' => 'حقل :attribute يجب ألا يزيد عن :max حرفاً.',
            'max.numeric' => 'حقل :attribute يجب ألا يزيد عن :max.',
            'max.file' => 'حجم ملف :attribute يجب ألا يزيد عن :max كيلوبايت.',
            'min.string' => 'حقل :attribute يجب ألا يقل عن :min حروف.',
            'min.numeric' => 'حقل :attribute يجب ألا يقل عن :min.',
            'in' => 'القيمة المختارة في حقل :attribute غير صحيحة.',
            'exists' => 'القيمة المختارة في حقل :attribute غير موجودة.',
            'unique' => 'قيمة حقل :attribute مستخدمة مسبقاً.',
            'confirmed' => 'تأكيد حقل :attribute غير مطابق.',
        ];
    }

    private function validationAttributes(Track $track): array
    {
        $attributes = [
            'full_name' => 'الاسم الرباعي',
            'national_id' => 'رقم الهوية',
            'phone_1' => 'رقم تواصل 1',
            'phone_2' => 'رقم تواصل 2',
            'gender' => 'الجنس',
            'birth_date' => 'تاريخ الميلاد',
            'governorate_id' => 'المحافظة',
            'displacement_status' => 'الإقامة',
            'residence_type_id' => 'مكان الإقامة الحالي',
            'current_address' => 'عنوان السكن الحالي',
            'family_members_count' => 'عدد أفراد الأسرة',
            'breadwinner_status' => 'معيل الأسرة',
            'employment_status' => 'حالة العمل',
            'income_type_id' => 'مستوى الدخل',
            'education_level' => 'المستوى التعليمي',
            'specialization' => 'التخصص',
            'health_status' => 'الوضع الصحي',
            'answers' => 'الإجابات',
        ];

        foreach ($track->form?->fields()->where('status', true)->get() ?? [] as $field) {
            $attributes['answers.' . $field->id] = $field->label;
        }

        return $attributes;
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
