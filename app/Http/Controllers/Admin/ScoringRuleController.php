<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ScoringRule;
use App\Models\Track;
use Illuminate\Http\Request;

class ScoringRuleController extends Controller
{
    public function index(Request $request)
    {
        $query = ScoringRule::with('track')->latest();

        if ($request->filled('track_id')) {
            $query->where('track_id', $request->track_id);
        }

        if ($request->filled('source')) {
            $query->where('source', $request->source);
        }

        $items = $query->paginate(15)->withQueryString();
        $tracks = Track::orderBy('title')->get();

        return view('admin.review-rules.scoring.index', compact('items', 'tracks'));
    }

    public function create()
    {
        $tracks = Track::orderBy('title')->get();

        return view('admin.review-rules.scoring.create', compact('tracks'));
    }

    public function store(Request $request)
    {
        $data = $this->validateData($request);

        $data['expected_value'] = $this->normalizeExpectedValue($request->expected_value);

        ScoringRule::create($data);

        return redirect()
            ->route('scoring-rules.index')
            ->with('success', 'تم إنشاء قاعدة النقاط بنجاح');
    }

    public function edit(ScoringRule $scoringRule)
    {
        $tracks = Track::orderBy('title')->get();

        return view('admin.review-rules.scoring.edit', compact('scoringRule', 'tracks'));
    }

    public function update(Request $request, ScoringRule $scoringRule)
    {
        $data = $this->validateData($request);

        $data['expected_value'] = $this->normalizeExpectedValue($request->expected_value);

        $scoringRule->update($data);

        return redirect()
            ->route('scoring-rules.index')
            ->with('success', 'تم تحديث قاعدة النقاط بنجاح');
    }

    public function destroy(ScoringRule $scoringRule)
    {
        $scoringRule->delete();

        return back()->with('success', 'تم حذف قاعدة النقاط');
    }

    private function validateData(Request $request): array
    {
        return $request->validate([
            'track_id' => 'required|exists:tracks,id',
            'field_name' => 'required|string|max:255',
            'source' => 'required|in:applicant,answer,track',
            'operator' => 'required|in:=,!=,>,>=,<,<=,in,not_in',
            'expected_value' => 'nullable|string',
            'score' => 'required|integer|min:0|max:100',
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