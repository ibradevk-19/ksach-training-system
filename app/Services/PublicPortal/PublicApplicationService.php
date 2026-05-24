<?php

namespace App\Services\PublicPortal;

use App\Models\Applicant;
use App\Models\Application;
use App\Models\ApplicationAnswer;
use App\Models\ApplicationFile;
use App\Models\FormField;
use App\Models\Track;
use App\Services\ApplicationService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;

class PublicApplicationService
{
    public function submit(Request $request, Track $track): Application
    {
        return DB::transaction(function () use ($request, $track) {

            $applicant = $this->createOrUpdateApplicant($request);

            $application = app(ApplicationService::class)
                ->createApplication($applicant, $track, [
                    'notes' => 'تم التقديم من البوابة العامة',
                ]);

            $this->saveDynamicAnswers($request, $application, $track);

            return $application;
        });
    }

    private function createOrUpdateApplicant(Request $request): Applicant
    {
        $applicant = Applicant::where('national_id', $request->national_id)->first();

        if ($applicant) {
            $applicant->update([
                'full_name' => $request->full_name,
                'phone_1' => $request->phone_1,
                'phone_2' => $request->phone_2,
                'gender' => $request->gender,
                'marital_status' => $request->marital_status,
                'birth_date' => $request->birth_date,
                'governorate_id' => $request->governorate_id,
                'population_community_id' => $request->population_community_id,
                'displacement_status' => $request->displacement_status,
                'residence_type_id' => $request->residence_type_id,
                'current_address' => $request->current_address,
                'family_members_count' => $request->family_members_count,
                'breadwinner_status' => $request->breadwinner_status,
                'employment_status' => $request->employment_status,
                'income_type_id' => $request->income_type_id,
                'education_level' => $request->education_level,
                'specialization' => $request->specialization,
                'health_status' => $request->health_status,
                'is_active' => true,
            ]);

            return $applicant;
        }

        return Applicant::create([
            'full_name' => $request->full_name,
            'national_id' => $request->national_id,
            'phone_1' => $request->phone_1,
            'phone_2' => $request->phone_2,
            'gender' => $request->gender,
            'marital_status' => $request->marital_status,
            'birth_date' => $request->birth_date,
            'governorate_id' => $request->governorate_id,
            'population_community_id' => $request->population_community_id,
            'displacement_status' => $request->displacement_status,
            'residence_type_id' => $request->residence_type_id,
            'current_address' => $request->current_address,
            'family_members_count' => $request->family_members_count,
            'breadwinner_status' => $request->breadwinner_status,
            'employment_status' => $request->employment_status,
            'income_type_id' => $request->income_type_id,
            'education_level' => $request->education_level,
            'specialization' => $request->specialization,
            'health_status' => $request->health_status,
            'is_active' => true,
        ]);
    }

    private function saveDynamicAnswers(Request $request, Application $application, Track $track): void
    {
        $form = $track->form;

        if (!$form) {
            throw ValidationException::withMessages([
                'form' => 'لا يوجد نموذج مرتبط بهذا المسار.',
            ]);
        }

        $fieldsQuery = $form->fields()->where('status', true);

        if ($request->has('visible_form_fields')) {
            $fieldsQuery->whereIn('id', $request->input('visible_form_fields', []));
        }

        $fields = $fieldsQuery->get();

        foreach ($fields as $field) {
            $inputName = 'answers.' . $field->id;

            if ($field->type === 'file') {
                if ($request->hasFile($inputName)) {
                    $file = $request->file($inputName);
                    $path = $file->store('application-files', 'public');

                    ApplicationFile::create([
                        'application_id' => $application->id,
                        'form_field_id' => $field->id,
                        'file_name' => $file->getClientOriginalName(),
                        'file_path' => $path,
                        'mime_type' => $file->getMimeType(),
                        'file_size' => $file->getSize(),
                    ]);
                }

                continue;
            }

            $answer = data_get($request->answers, $field->id);

            if (is_array($answer)) {
                $answer = json_encode($answer, JSON_UNESCAPED_UNICODE);
            }

            ApplicationAnswer::create([
                'application_id' => $application->id,
                'form_field_id' => $field->id,
                'answer' => $answer,
            ]);
        }
    }

}
