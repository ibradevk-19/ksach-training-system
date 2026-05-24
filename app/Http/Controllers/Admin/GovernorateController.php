<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Governorate;
use Illuminate\Http\Request;

class GovernorateController extends Controller
{
    public function index()
    {
        $items = Governorate::withCount([
            'populationCommunities' => fn ($query) => $query->where('status', true),
        ])->latest()->paginate(10);

        return view('admin.governorates.index', compact('items'));
    }

    public function create()
    {
        return view('admin.governorates.create');
    }

    public function store(Request $request)
    {
        $data = $this->validateData($request);

        $governorate = Governorate::create([
            'name' => $data['name'],
            'status' => $data['status'] ?? 1,
        ]);

        $this->syncPopulationCommunities($governorate, $data['population_communities'] ?? '');

        return redirect()
            ->route('admin.governorates.index')
            ->with('success', 'تمت الإضافة');
    }

    public function edit(Governorate $governorate)
    {
        $governorate->load([
            'populationCommunities' => fn ($query) => $query->where('status', true)->orderBy('name'),
        ]);

        return view('admin.governorates.edit', compact('governorate'));
    }

    public function update(Request $request, Governorate $governorate)
    {
        $data = $this->validateData($request);

        $governorate->update([
            'name' => $data['name'],
            'status' => $data['status'] ?? 1,
        ]);

        $this->syncPopulationCommunities($governorate, $data['population_communities'] ?? '');

        return redirect()
            ->route('admin.governorates.index')
            ->with('success', 'تم التعديل');
    }

    public function destroy(Governorate $governorate)
    {
        $governorate->delete();

        return back()->with('success', 'تم الحذف');
    }

    private function validateData(Request $request): array
    {
        return $request->validate([
            'name' => 'required|string|max:255',
            'status' => 'nullable|boolean',
            'population_communities' => 'nullable|string',
        ]);
    }

    private function syncPopulationCommunities(Governorate $governorate, ?string $communities): void
    {
        $names = collect(preg_split('/\r\n|\r|\n/', (string) $communities))
            ->map(fn ($name) => trim($name))
            ->filter()
            ->unique()
            ->values();

        $governorate->populationCommunities()->update(['status' => false]);

        foreach ($names as $name) {
            $governorate->populationCommunities()->updateOrCreate(
                ['name' => $name],
                ['status' => true]
            );
        }
    }
}
