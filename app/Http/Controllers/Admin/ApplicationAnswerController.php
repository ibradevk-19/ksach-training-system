<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Application;
use App\Models\ApplicationAnswer;
use App\Models\ApplicationFile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ApplicationAnswerController extends Controller
{
    public function edit(Application $application)
    {
        $application->load([
            'track.form.sections.fields',
            'answers',
            'files',
        ]);

        $form = $application->track->form;

        if (!$form) {
            return back()->with('error', 'لا يوجد نموذج مرتبط بهذا المسار.');
        }

        return view('admin.applications.answers.edit', compact('application', 'form'));
    }

    public function update(Request $request, Application $application)
    {
        $application->load('track.form.fields');

        $form = $application->track->form;

        if (!$form) {
            return back()->with('error', 'لا يوجد نموذج مرتبط بهذا المسار.');
        }

        $rules = [];

        foreach ($form->fields()->where('status', true)->get() as $field) {
            $fieldRules = [];

            if ($field->is_required) {
                $fieldRules[] = 'required';
            } else {
                $fieldRules[] = 'nullable';
            }

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

        $request->validate($rules);

        DB::transaction(function () use ($request, $application, $form) {
            foreach ($form->fields()->where('status', true)->get() as $field) {
                $inputName = 'answers.' . $field->id;

                if ($field->type === 'file') {
                    if ($request->hasFile($inputName)) {
                        $file = $request->file($inputName);

                        $path = $file->store('application-files', 'public');

                        ApplicationFile::updateOrCreate(
                            [
                                'application_id' => $application->id,
                                'form_field_id' => $field->id,
                            ],
                            [
                                'file_name' => $file->getClientOriginalName(),
                                'file_path' => $path,
                                'mime_type' => $file->getMimeType(),
                                'file_size' => $file->getSize(),
                            ]
                        );
                    }

                    continue;
                }

                $answer = data_get($request->answers, $field->id);

                if (is_array($answer)) {
                    $answer = json_encode($answer, JSON_UNESCAPED_UNICODE);
                }

                ApplicationAnswer::updateOrCreate(
                    [
                        'application_id' => $application->id,
                        'form_field_id' => $field->id,
                    ],
                    [
                        'answer' => $answer,
                    ]
                );
            }
        });

        return redirect()
            ->route('admin.applications.show', $application)
            ->with('success', 'تم حفظ إجابات النموذج بنجاح');
    }
}
