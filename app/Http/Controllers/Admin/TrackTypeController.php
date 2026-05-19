<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\TrackType;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class TrackTypeController extends Controller
{
    public function index()
    {
        $items = TrackType::latest()->paginate(10);

        return view('admin.track-types.index', compact('items'));
    }

    public function create()
    {
        return view('admin.track-types.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'icon' => 'nullable|string|max:255',
            'color' => 'nullable|string|max:50',
            'description' => 'nullable|string',
            'status' => 'required|boolean',
        ]);

        TrackType::create([
            'name' => $request->name,
            'slug' => Str::slug($request->name) ?: Str::random(8),
            'icon' => $request->icon,
            'color' => $request->color,
            'description' => $request->description,
            'status' => $request->status,
        ]);

        return redirect()
            ->route('admin.track-types.index')
            ->with('success', 'تم إضافة نوع المسار بنجاح');
    }

    public function edit(TrackType $trackType)
    {
        return view('admin.track-types.edit', compact('trackType'));
    }

    public function update(Request $request, TrackType $trackType)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'icon' => 'nullable|string|max:255',
            'color' => 'nullable|string|max:50',
            'description' => 'nullable|string',
            'status' => 'required|boolean',
        ]);

        $trackType->update([
            'name' => $request->name,
            'slug' => Str::slug($request->name) ?: $trackType->slug,
            'icon' => $request->icon,
            'color' => $request->color,
            'description' => $request->description,
            'status' => $request->status,
        ]);

        return redirect()
            ->route('admin.track-types.index')
            ->with('success', 'تم تحديث نوع المسار بنجاح');
    }

    public function destroy(TrackType $trackType)
    {
        $trackType->delete();

        return back()->with('success', 'تم حذف نوع المسار');
    }
}
