<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;

class PermissionController extends Controller
{
    public function __construct()
    {
        // $this->middleware('permission:permissions.view')->only('index');
        // $this->middleware('permission:permissions.create')->only('create', 'store');
        // $this->middleware('permission:permissions.edit')->only('edit', 'update');
        // $this->middleware('permission:permissions.delete')->only('destroy');
    }

    public function index()
    {
        $permissions = Permission::latest()->paginate(10);

        return view('admin.permissions.index', compact('permissions'));
    }

    public function create()
    {
        return view('admin.permissions.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:permissions,name',
        ]);

        Permission::create(['name' => $request->name]);

        return redirect()
            ->route('admin.permissions.index')
            ->with('success', 'تم إنشاء الصلاحية بنجاح');
    }

    public function edit(Permission $permission)
    {
        return view('admin.permissions.edit', compact('permission'));
    }

    public function update(Request $request, Permission $permission)
    {
        $request->validate([
            'name' => 'required|unique:permissions,name,' . $permission->id,
        ]);

        $permission->update(['name' => $request->name]);

        return redirect()
            ->route('admin.permissions.index')
            ->with('success', 'تم تحديث الصلاحية بنجاح');
    }

    public function destroy(Permission $permission)
    {
        $permission->delete();

        return back()->with('success', 'تم حذف الصلاحية');
    }
}
