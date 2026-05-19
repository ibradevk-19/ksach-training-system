@extends('layouts.app')

@section('content')

<div class="container-xl">

    <div class="page-header d-print-none">

        <div class="row align-items-center">

            <div class="col">

                <h2 class="page-title">
                    إضافة نوع دخل
                </h2>

            </div>

        </div>

    </div>

    <form action="{{ route('admin.income-types.store') }}"
          method="POST">

        @csrf

        @include('admin.income-types.form',[
            'button' => 'إضافة'
        ])

    </form>

</div>

@endsection