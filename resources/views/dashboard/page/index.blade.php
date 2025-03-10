@extends('layouts.dashboard')

@section('page-header')
<div class="content-header row">
    <div class="content-header-left col-md-9 col-12 mb-2">
        <div class="row breadcrumbs-top">
            <div class="col-12">
                <h2 class="content-header-title float-start mb-0">الصفحات</h2>
                <div class="breadcrumb-wrapper">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">الرئيسية</a>
                        </li>
                        <li class="breadcrumb-item"><a href="#">عرض الصفحات</a>
                        </li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    <div class="content-header-right text-md-end col-md-3 col-12">
        <div class="mb-1 breadcrumb-right">
            <a class="btn btn-primary waves-effect waves-float waves-light" href="{{ route('page.add') }}">إضافة صفحة جديدة</a>
        </div>
    </div>
</div>
@endsection

@section('content')
    <section id="pageView">
        <!-- show blog -->
        <div class="page-list-wrapper">
            <div class="card">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <tr>
                                <th>اسم الصفحة</th>
                                <th>الصورة الرئيسية</th>
                                <th>مكان الظهور</th>
                                <th>إجراء</th>
                            </tr>
                            @forelse ($pages as $page)
                                <tr>
                                    <td>{{ $page->title }}</td>
                                    <td>
                                        @if ($page->main_image !== null)
                                            <img class="img_thumb" src="{{ asset($page->main_image) }}" alt="{{ $page->title }}">
                                        @endif
                                    </td>
                                    <td>{{ $page->location }}</td>
                                    <td>
                                        <a class="btn btn-primary waves-effect waves-float waves-light" href="{{ route('page.show', $page->id) }}"> 
                                            <i data-feather="eye" class="me-50"></i>
                                            <span>عرض</span>
                                        </a>
                                        <a class="btn btn-success waves-effect waves-float waves-light" href="{{ route('page.edit', $page->id) }}"> 
                                            <i data-feather="edit-2" class="me-50"></i>
                                            <span>تعديل</span>
                                        </a>
                                        <a class="btn btn-danger waves-effect waves-float waves-light delBtn" href="#" data-id="{{ $page->id }}" data-bs-toggle="modal" data-bs-target="#DelModel">
                                            <i data-feather="trash" class="me-50"></i>
                                            <span>حذف</span>
                                        </a>
                                    </td>
                                </tr>
                            @empty
                                <tr class="text-center">
                                    <td colspan="5">لا توجد اى صفحات مضافة</td>
                                </tr>
                            @endforelse
                        </table>
                    </div>
                </div>
                <div class="card-footer">
                    <div class="page-num">
                        {{ $pages->links() }}
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- model delete -->
    @include('dashboard.page.Mdel')
@endsection


@section('js')
<script>
    $(".delBtn").on('click', function(){
        let id = $(this).attr('data-id')
        $("#DelModel .id").val(id);
    })
</script>
@endsection