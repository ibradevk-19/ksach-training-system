@extends('layouts.app')

@section('content')

<div class="container-xl">

    <div class="page-header d-print-none">

        <div class="row align-items-center">

            <div class="col">

                <h2 class="page-title">
                    تعديل نوع الإقامة
                </h2>

            </div>

        </div>

    </div>

    <form action="{{ route('admin.residence-types.update',$residenceType) }}"
          method="POST">

        @csrf
        @method('PUT')

        @include('admin.residence-types.form',[
            'button' => 'تحديث'
        ])

    </form>

</div>

@endsection