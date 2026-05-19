<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Form;
use App\Models\Track;
use Illuminate\Http\Request;

class FormController extends Controller
{
    public function index()
    {
        $forms = Form::with('track')->latest()->paginate(10);

        return view('admin.forms.index', compact('forms'));
    }

    public function create()
    {
        $tracks = Track::whereDoesntHave('form')
            ->orderBy('title')
            ->get();

        return view('admin.forms.create', compact('tracks'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'track_id' => 'required|exists:tracks,id|unique:forms,track_id',
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'is_multi_step' => 'required|boolean',
            'status' => 'required|boolean',
        ]);

        Form::create($request->only([
            'track_id',
            'title',
            'description',
            'is_multi_step',
            'status',
        ]));

        return redirect()
            ->route('admin.forms.index')
            ->with('success', 'تم إنشاء النموذج بنجاح');
    }

    public function edit(Form $form)
    {
        $tracks = Track::orderBy('title')->get();

        return view('admin.forms.edit', compact('form', 'tracks'));
    }

    public function update(Request $request, Form $form)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'is_multi_step' => 'required|boolean',
            'status' => 'required|boolean',
        ]);

        $form->update($request->only([
            'title',
            'description',
            'is_multi_step',
            'status',
        ]));

        return redirect()
            ->route('admin.forms.index')
            ->with('success', 'تم تحديث النموذج');
    }

    public function builder(Form $form)
    {
        $form->load([
            'track',
            'sections.fields',
            'fields',
        ]);

        return view('admin.forms.builder', compact('form'));
    }

    public function destroy(Form $form)
    {
        $form->delete();

        return back()->with('success', 'تم حذف النموذج');
    }
}
