<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ResidenceType;
use Illuminate\Http\Request;

class ResidenceTypeController extends Controller
{
    public function index()
    {
        $items = ResidenceType::latest()->paginate(10);

        return view('admin.residence-types.index', compact('items'));
    }

    public function create()
    {
        return view('admin.residence-types.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        ResidenceType::create([
            'name' => $request->name,
            'status' => $request->status ?? 1,
        ]);

        return redirect()
            ->route('admin.residence-types.index')
            ->with('success', 'تم إضافة نوع الإقامة بنجاح');
    }

    public function edit(ResidenceType $residenceType)
    {
        return view('admin.residence-types.edit', compact('residenceType'));
    }

    public function update(Request $request, ResidenceType $residenceType)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $residenceType->update([
            'name' => $request->name,
            'status' => $request->status ?? 1,
        ]);

        return redirect()
            ->route('admin.residence-types.index')
            ->with('success', 'تم تحديث نوع الإقامة');
    }

    public function destroy(ResidenceType $residenceType)
    {
        $residenceType->delete();

        return back()->with('success', 'تم حذف نوع الإقامة');
    }
}