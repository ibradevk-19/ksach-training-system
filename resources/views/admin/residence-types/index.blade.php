@extends('layouts.app')

@section('content')

<div class="container-xl">

    <div class="page-header d-print-none">

        <div class="row align-items-center">

            <div class="col">
                <h2 class="page-title">
                    أنواع الإقامة
                </h2>
            </div>

            <div class="col-auto">

                <a href="{{ route('admin.residence-types.create') }}"
                   class="btn btn-primary">

                    إضافة نوع إقامة

                </a>

            </div>

        </div>

    </div>

    <div class="card">

        <div class="table-responsive">

            <table class="table table-vcenter card-table">

                <thead>

                    <tr>
                        <th>#</th>
                        <th>الاسم</th>
                        <th>الحالة</th>
                        <th>الإجراءات</th>
                    </tr>

                </thead>

                <tbody>

                    @forelse($items as $item)

                    <tr>

                        <td>{{ $item->id }}</td>

                        <td>{{ $item->name }}</td>

                        <td>

                            @if($item->status)

                                <span class="badge bg-success">
                                    نشط
                                </span>

                            @else

                                <span class="badge bg-danger">
                                    غير نشط
                                </span>

                            @endif

                        </td>

                        <td>

                            <div class="btn-list">

                                <a href="{{ route('admin.residence-types.edit',$item) }}"
                                   class="btn btn-warning btn-sm">

                                    تعديل

                                </a>

                                <form action="{{ route('admin.residence-types.destroy',$item) }}"
                                      method="POST">

                                    @csrf
                                    @method('DELETE')

                                    <button class="btn btn-danger btn-sm"
                                            onclick="return confirm('هل أنت متأكد؟')">

                                        حذف

                                    </button>

                                </form>

                            </div>

                        </td>

                    </tr>

                    @empty

                    <tr>

                        <td colspan="4" class="text-center">

                            لا توجد بيانات

                        </td>

                    </tr>

                    @endforelse

                </tbody>

            </table>

        </div>

        <div class="card-footer">

            {{ $items->links() }}

        </div>

    </div>

</div>

@endsection