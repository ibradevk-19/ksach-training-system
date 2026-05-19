<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Governorate;
use Illuminate\Http\Request;

class GovernorateController extends Controller
{
    public function index()
    {
        $items = Governorate::latest()->paginate(10);

        return view('admin.governorates.index', compact('items'));
    }

    public function create()
    {
        return view('admin.governorates.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required'
        ]);

        Governorate::create([
            'name' => $request->name,
            'status' => $request->status ?? 1
        ]);

        return redirect()
            ->route('admin.governorates.index')
            ->with('success','تم الإضافة');
    }

    public function edit(Governorate $governorate)
    {
        return view('admin.governorates.edit', compact('governorate'));
    }

    public function update(Request $request, Governorate $governorate)
    {
        $governorate->update([
            'name' => $request->name,
            'status' => $request->status ?? 1
        ]);

        return redirect()
            ->route('admin.governorates.index')
            ->with('success','تم التعديل');
    }

    public function destroy(Governorate $governorate)
    {
        $governorate->delete();

        return back()->with('success','تم الحذف');
    }
}