<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Applicant;
use App\Models\Governorate;
use App\Models\IncomeType;
use App\Models\ResidenceType;
use Illuminate\Http\Request;

class ApplicantController extends Controller
{
    public function index(Request $request)
    {
        $query = Applicant::with([
            'governorate',
            'residenceType',
            'incomeType',
        ])->latest();

        if ($request->filled('q')) {
            $query->where(function ($q) use ($request) {
                $q->where('full_name', 'like', '%' . $request->q . '%')
                    ->orWhere('national_id', 'like', '%' . $request->q . '%')
                    ->orWhere('phone_1', 'like', '%' . $request->q . '%')
                    ->orWhere('phone_2', 'like', '%' . $request->q . '%');
            });
        }

        if ($request->filled('gender')) {
            $query->where('gender', $request->gender);
        }

        if ($request->filled('governorate_id')) {
            $query->where('governorate_id', $request->governorate_id);
        }

        if ($request->filled('displacement_status')) {
            $query->where('displacement_status', $request->displacement_status);
        }

        if ($request->filled('employment_status')) {
            $query->where('employment_status', $request->employment_status);
        }

        if ($request->filled('health_status')) {
            $query->where('health_status', $request->health_status);
        }

        if ($request->filled('education_level')) {
            $query->where('education_level', $request->education_level);
        }

        if ($request->filled('is_active')) {
            $query->where('is_active', $request->is_active);
        }

        $items = $query->paginate(15)->withQueryString();

        $governorates = Governorate::where('status', true)->get();

        return view('admin.applicants.index', compact('items', 'governorates'));
    }

    public function create()
    {
        return view('admin.applicants.create', $this->formData());
    }

    public function store(Request $request)
    {
        $data = $this->validateData($request);

        $data = $this->uploadFiles($request, $data);

        Applicant::create($data);

        return redirect()
            ->route('admin.applicants.index')
            ->with('success', 'تم إضافة المتقدم بنجاح');
    }

    public function show(Applicant $applicant)
    {
        $applicant->load([
            'governorate',
            'residenceType',
            'incomeType',
        ]);

        return view('admin.applicants.show', compact('applicant'));
    }

    public function edit(Applicant $applicant)
    {
        return view('admin.applicants.edit', array_merge(
            $this->formData(),
            compact('applicant')
        ));
    }

    public function update(Request $request, Applicant $applicant)
    {
        $data = $this->validateData($request, $applicant->id);

        $data = $this->uploadFiles($request, $data);

        $applicant->update($data);

        return redirect()
            ->route('admin.applicants.index')
            ->with('success', 'تم تحديث بيانات المتقدم بنجاح');
    }

    public function destroy(Applicant $applicant)
    {
        $applicant->delete();

        return back()->with('success', 'تم حذف المتقدم');
    }

    private function formData(): array
    {
        return [
            'governorates' => Governorate::where('status', true)->get(),
            'residenceTypes' => ResidenceType::where('status', true)->get(),
            'incomeTypes' => IncomeType::where('status', true)->get(),
        ];
    }

    private function validateData(Request $request, $id = null): array
    {
        return $request->validate([
            'full_name' => 'required|string|max:255',

            'national_id' => 'required|string|max:20|unique:applicants,national_id,' . $id,

            'phone_1' => 'required|string|max:20|unique:applicants,phone_1,' . $id,
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

            'identity_image' => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:5120',
            'medical_report' => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:5120',
            'education_certificate' => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:5120',

            'is_active' => 'required|boolean',

            'notes' => 'nullable|string',
        ]);
    }

    private function uploadFiles(Request $request, array $data): array
    {
        foreach (['identity_image', 'medical_report', 'education_certificate'] as $fileField) {
            if ($request->hasFile($fileField)) {
                $data[$fileField] = $request->file($fileField)
                    ->store('applicants', 'public');
            }
        }

        return $data;
    }
}
