@extends('layouts.app')

@section('content')

<div class="container-xl">

    <div class="page-header d-print-none">

        <div class="row align-items-center">

            <div class="col">

                <h2 class="page-title">
                    تعديل المحافظة
                </h2>

            </div>

        </div>

    </div>

    <form action="{{ route('admin.governorates.update',$governorate) }}"
          method="POST">

        @csrf
        @method('PUT')

        @include('admin.governorates.form',[
            'button' => 'تحديث'
        ])

    </form>

</div>

@endsection