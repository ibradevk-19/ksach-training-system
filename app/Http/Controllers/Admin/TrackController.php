<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Track;
use App\Models\TrackCategory;
use App\Models\TrackType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class TrackController extends Controller
{
    public function index(Request $request)
    {
        $query = Track::with(['type', 'category', 'creator'])->latest();

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        if ($request->filled('track_type_id')) {
            $query->where('track_type_id', $request->track_type_id);
        }

        if ($request->filled('track_category_id')) {
            $query->where('track_category_id', $request->track_category_id);
        }

        if ($request->filled('gender')) {
            $query->where('gender', $request->gender);
        }

        if ($request->filled('q')) {
            $query->where('title', 'like', '%' . $request->q . '%');
        }

        $items = $query->paginate(10)->withQueryString();

        $types = TrackType::where('status', true)->get();
        $categories = TrackCategory::where('status', true)->get();

        return view('admin.tracks.index', compact('items', 'types', 'categories'));
    }

    public function create()
    {
        $types = TrackType::where('status', true)->get();
        $categories = TrackCategory::where('status', true)->get();

        return view('admin.tracks.create', compact('types', 'categories'));
    }

    public function store(Request $request)
    {
        $data = $this->validateData($request);

        $data['slug'] = Str::slug($request->title) ?: Str::random(8);
        $data['created_by'] = Auth::id();
        $data['allow_waiting_list'] = $request->boolean('allow_waiting_list');
        $data['requires_review'] = $request->boolean('requires_review');
        $data['is_featured'] = $request->boolean('is_featured');

        if ($request->hasFile('thumbnail')) {
            $data['thumbnail'] = $request->file('thumbnail')->store('tracks', 'public');
        }

        Track::create($data);

        return redirect()
            ->route('admin.tracks.index')
            ->with('success', 'تم إضافة المسار بنجاح');
    }

    public function edit(Track $track)
    {
        $types = TrackType::where('status', true)->get();
        $categories = TrackCategory::where('status', true)->get();

        return view('admin.tracks.edit', compact('track', 'types', 'categories'));
    }

    public function update(Request $request, Track $track)
    {
        $data = $this->validateData($request, $track->id);

        $data['slug'] = Str::slug($request->title) ?: $track->slug;
        $data['allow_waiting_list'] = $request->boolean('allow_waiting_list');
        $data['requires_review'] = $request->boolean('requires_review');
        $data['is_featured'] = $request->boolean('is_featured');

        if ($request->hasFile('thumbnail')) {
            $data['thumbnail'] = $request->file('thumbnail')->store('tracks', 'public');
        }

        $track->update($data);

        return redirect()
            ->route('admin.tracks.index')
            ->with('success', 'تم تحديث المسار بنجاح');
    }

    public function destroy(Track $track)
    {
        $track->delete();

        return back()->with('success', 'تم حذف المسار');
    }

    private function validateData(Request $request, $id = null): array
    {
        return $request->validate([
            'track_type_id' => 'nullable|exists:track_types,id',
            'track_category_id' => 'nullable|exists:track_categories,id',

            'title' => 'required|string|max:255',
            'short_description' => 'nullable|string|max:500',
            'description' => 'nullable|string',

            'thumbnail' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',

            'start_date' => 'nullable|date',
            'end_date' => 'nullable|date|after_or_equal:start_date',

            'registration_start' => 'nullable|date',
            'registration_end' => 'nullable|date|after_or_equal:registration_start',

            'seats' => 'required|integer|min:0',

            'gender' => 'required|in:male,female,both',

            'min_age' => 'nullable|integer|min:0|max:100',
            'max_age' => 'nullable|integer|min:0|max:100|gte:min_age',

            'status' => 'required|in:draft,published,closed,archived',
        ]);
    }
}
