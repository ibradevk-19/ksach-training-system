<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Form;
use App\Models\FormSection;
use Illuminate\Http\Request;

class FormSectionController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'form_id' => 'required|exists:forms,id',
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'sort_order' => 'nullable|integer|min:0',
        ]);

        FormSection::create([
            'form_id' => $request->form_id,
            'title' => $request->title,
            'description' => $request->description,
            'sort_order' => $request->sort_order ?? 0,
        ]);

        return back()->with('success', 'تم إضافة القسم');
    }

    public function edit(FormSection $formSection)
    {
        return view('admin.forms.sections.edit', compact('formSection'));
    }

    public function update(Request $request, FormSection $formSection)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'sort_order' => 'nullable|integer|min:0',
        ]);

        $formSection->update([
            'title' => $request->title,
            'description' => $request->description,
            'sort_order' => $request->sort_order ?? 0,
        ]);

        return redirect()
            ->route('admin.forms.builder', $formSection->form_id)
            ->with('success', 'تم تحديث القسم');
    }

    public function destroy(FormSection $formSection)
    {
        $formId = $formSection->form_id;

        $formSection->delete();

        return redirect()
            ->route('admin.forms.builder', $formId)
            ->with('success', 'تم حذف القسم');
    }
}
