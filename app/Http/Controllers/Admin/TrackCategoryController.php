<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\TrackCategory;
use Illuminate\Http\Request;

class TrackCategoryController extends Controller
{
    public function index()
    {
        $items = TrackCategory::latest()->paginate(10);

        return view('admin.track-categories.index', compact('items'));
    }

    public function create()
    {
        return view('admin.track-categories.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'status' => 'required|boolean',
        ]);

        TrackCategory::create($request->only([
            'name',
            'description',
            'status',
        ]));

        return redirect()
            ->route('admin.track-categories.index')
            ->with('success', 'تم إضافة التصنيف بنجاح');
    }

    public function edit(TrackCategory $trackCategory)
    {
        return view('admin.track-categories.edit', compact('trackCategory'));
    }

    public function update(Request $request, TrackCategory $trackCategory)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'status' => 'required|boolean',
        ]);

        $trackCategory->update($request->only([
            'name',
            'description',
            'status',
        ]));

        return redirect()
            ->route('admin.track-categories.index')
            ->with('success', 'تم تحديث التصنيف بنجاح');
    }

    public function destroy(TrackCategory $trackCategory)
    {
        $trackCategory->delete();

        return back()->with('success', 'تم حذف التصنيف');
    }
}
