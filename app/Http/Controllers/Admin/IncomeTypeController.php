<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\IncomeType;
use Illuminate\Http\Request;

class IncomeTypeController extends Controller
{
    public function index()
    {
        $items = IncomeType::latest()->paginate(10);

        return view('admin.income-types.index', compact('items'));
    }

    public function create()
    {
        return view('admin.income-types.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        IncomeType::create([
            'name' => $request->name,
            'status' => $request->status ?? 1,
        ]);

        return redirect()
            ->route('admin.income-types.index')
            ->with('success', 'تم إضافة نوع الدخل');
    }

    public function edit(IncomeType $incomeType)
    {
        return view('admin.income-types.edit', compact('incomeType'));
    }

    public function update(Request $request, IncomeType $incomeType)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $incomeType->update([
            'name' => $request->name,
            'status' => $request->status ?? 1,
        ]);

        return redirect()
            ->route('admin.income-types.index')
            ->with('success', 'تم تحديث نوع الدخل');
    }

    public function destroy(IncomeType $incomeType)
    {
        $incomeType->delete();

        return back()->with('success', 'تم حذف نوع الدخل');
    }
}