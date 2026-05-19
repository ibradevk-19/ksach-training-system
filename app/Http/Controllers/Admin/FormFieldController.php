<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Form;
use App\Models\FormField;
use App\Models\FormSection;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class FormFieldController extends Controller
{
    public function create(Request $request)
    {
        $form = Form::with('sections')->findOrFail($request->form_id);

        return view('admin.forms.fields.create', compact('form'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'form_id' => 'required|exists:forms,id',
            'form_section_id' => 'nullable|exists:form_sections,id',
            'label' => 'required|string|max:255',
            'name' => 'nullable|string|max:255',
            'type' => 'required|in:text,textarea,number,date,select,radio,checkbox,file',
            'placeholder' => 'nullable|string|max:255',
            'options_text' => 'nullable|string',
            'is_required' => 'nullable|boolean',
            'validation_rules' => 'nullable|string|max:255',
            'width' => 'required|integer|in:3,4,6,8,12',
            'sort_order' => 'nullable|integer|min:0',
            'status' => 'required|boolean',
        ]);

        $name = $request->name ?: Str::slug($request->label, '_');

        $options = null;

        if (in_array($request->type, ['select', 'radio', 'checkbox'])) {
            $options = collect(explode("\n", $request->options_text))
                ->map(fn ($item) => trim($item))
                ->filter()
                ->values()
                ->toArray();
        }

        FormField::create([
            'form_id' => $request->form_id,
            'form_section_id' => $request->form_section_id,
            'label' => $request->label,
            'name' => $name,
            'type' => $request->type,
            'placeholder' => $request->placeholder,
            'options' => $options,
            'is_required' => $request->boolean('is_required'),
            'validation_rules' => $request->validation_rules,
            'width' => $request->width,
            'sort_order' => $request->sort_order ?? 0,
            'status' => $request->status,
        ]);

        return redirect()
            ->route('admin.forms.builder', $request->form_id)
            ->with('success', 'تم إضافة الحقل');
    }

    public function edit(FormField $formField)
    {
        $form = Form::with('sections')->findOrFail($formField->form_id);

        return view('admin.forms.fields.edit', compact('formField', 'form'));
    }

    public function update(Request $request, FormField $formField)
    {
        $request->validate([
            'form_section_id' => 'nullable|exists:form_sections,id',
            'label' => 'required|string|max:255',
            'name' => 'required|string|max:255',
            'type' => 'required|in:text,textarea,number,date,select,radio,checkbox,file',
            'placeholder' => 'nullable|string|max:255',
            'options_text' => 'nullable|string',
            'is_required' => 'nullable|boolean',
            'validation_rules' => 'nullable|string|max:255',
            'width' => 'required|integer|in:3,4,6,8,12',
            'sort_order' => 'nullable|integer|min:0',
            'status' => 'required|boolean',
        ]);

        $options = null;

        if (in_array($request->type, ['select', 'radio', 'checkbox'])) {
            $options = collect(explode("\n", $request->options_text))
                ->map(fn ($item) => trim($item))
                ->filter()
                ->values()
                ->toArray();
        }

        $formField->update([
            'form_section_id' => $request->form_section_id,
            'label' => $request->label,
            'name' => $request->name,
            'type' => $request->type,
            'placeholder' => $request->placeholder,
            'options' => $options,
            'is_required' => $request->boolean('is_required'),
            'validation_rules' => $request->validation_rules,
            'width' => $request->width,
            'sort_order' => $request->sort_order ?? 0,
            'status' => $request->status,
        ]);

        return redirect()
            ->route('admin.forms.builder', $formField->form_id)
            ->with('success', 'تم تحديث الحقل');
    }

    public function destroy(FormField $formField)
    {
        $formId = $formField->form_id;

        $formField->delete();

        return redirect()
            ->route('admin.forms.builder', $formId)
            ->with('success', 'تم حذف الحقل');
    }
}
