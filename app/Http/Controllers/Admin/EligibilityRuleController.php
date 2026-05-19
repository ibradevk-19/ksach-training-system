<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\EligibilityRule;
use App\Models\Track;
use Illuminate\Http\Request;

class EligibilityRuleController extends Controller
{
    public function index(Request $request)
    {
        $query = EligibilityRule::with('track')->latest();

        if ($request->filled('track_id')) {
            $query->where('track_id', $request->track_id);
        }

        if ($request->filled('source')) {
            $query->where('source', $request->source);
        }

        $items = $query->paginate(15)->withQueryString();
        $tracks = Track::orderBy('title')->get();

        return view('admin.review-rules.eligibility.index', compact('items', 'tracks'));
    }

    public function create()
    {
        $tracks = Track::orderBy('title')->get();

        return view('admin.review-rules.eligibility.create', compact('tracks'));
    }

    public function store(Request $request)
    {
        $data = $this->validateData($request);

        $data['expected_value'] = $this->normalizeExpectedValue($request->expected_value);

        EligibilityRule::create($data);

        return redirect()
            ->route('eligibility-rules.index')
            ->with('success', 'تم إنشاء قاعدة الأهلية بنجاح');
    }

    public function edit(EligibilityRule $eligibilityRule)
    {
        $tracks = Track::orderBy('title')->get();

        return view('admin.review-rules.eligibility.edit', compact('eligibilityRule', 'tracks'));
    }

    public function update(Request $request, EligibilityRule $eligibilityRule)
    {
        $data = $this->validateData($request);

        $data['expected_value'] = $this->normalizeExpectedValue($request->expected_value);

        $eligibilityRule->update($data);

        return redirect()
            ->route('eligibility-rules.index')
            ->with('success', 'تم تحديث قاعدة الأهلية بنجاح');
    }

    public function destroy(EligibilityRule $eligibilityRule)
    {
        $eligibilityRule->delete();

        return back()->with('success', 'تم حذف قاعدة الأهلية');
    }

    private function validateData(Request $request): array
    {
        return $request->validate([
            'track_id' => 'required|exists:tracks,id',
            'field_name' => 'required|string|max:255',
            'source' => 'required|in:applicant,answer,track',
            'operator' => 'required|in:=,!=,>,>=,<,<=,in,not_in',
            'expected_value' => 'nullable|string',
            'failure_message' => 'required|string|max:500',
            'is_active' => 'required|boolean',
        ]);
    }

    private function normalizeExpectedValue(?string $value): array
    {
        if (!$value) {
            return [];
        }

        return collect(explode("\n", $value))
            ->map(fn ($item) => trim($item))
            ->filter()
            ->values()
            ->toArray();
    }
}