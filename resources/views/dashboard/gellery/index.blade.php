@extends('layouts.dashboard')

@section('page-header')
<div class="content-header row">
    <div class="content-header-left col-md-9 col-12 mb-2">
        <div class="row breadcrumbs-top">
            <div class="col-12">
                <h2 class="content-header-title float-start mb-0">المعرض</h2>
                <div class="breadcrumb-wrapper">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="#">السلايدر</a>
                        </li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('content')
    <section id="sliders">
        <!-- validation -->
        @if($errors->any())
            <div class="alert alert-danger">
                <h3 class="alert-heading">حدث خطأ ما</h3>
                @foreach ($errors->all() as $error)
                    <div class="alert-body">
                        {{ $error }}
                    </div>
                @endforeach
            </div>
        @endif

        <!-- show success message -->
        @if (session('success'))
            <div class="alert alert-success">
                <h3 class="alert-heading">عملية ناجحة</h3>
                <div class="alert-body">
                    {{session('success')}}
                </div>
            </div>
        @endif     
          
        <div class="card">
            <div class="card-header">
                <h3>السلايدر</h3>
                <div class="table-action">
                    <a href="{{ route('slider.create') }}" class="btn btn-primary waves-effect waves-float waves-light">أضف معرض جديد</a>
                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered">
                        <tr>
                            <th>اسم السلايدر</th>
                            <th>عدد العناصر في كل شريحة</th>
                            <th>الحالة</th>
                            <th>إعدادات</th>
                        </tr>
                        @foreach ($sliders as $slider)
                            <tr>
                                <td>{{ $slider->name }}</td>
                                <td>{{ $slider->items_number }}</td>
                                <td>{{ $slider->is_active == 1 ? 'مفعل' : 'غير مفعل'}}</td>
                                <td>
                                    <a href="{{ route('slider.show', $slider->id) }}" class="btn btn-icon rounded-circle btn-outline-primary waves-effect">
                                        <i data-feather='settings'></i>
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    </table>
                </div>
            </div>
        </div>
    </section>
@endsection