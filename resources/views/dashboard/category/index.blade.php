@extends('layouts.dashboard')

@section('content')
    <section id="category">
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

        <!-- show table -->
        <div class="card">  
            <div class="card-header">
                <h3>أقسام الموقع</h3>
                <div class="table-action">
                    <button class="btn btn-primary waves-effect waves-float waves-light" data-bs-toggle="modal" data-bs-target="#createModel">أضف قسم جديد</button>
                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>رقم القسم</th>
                                <th>اسم القسم</th>
                                <th>الحالة</th>
                                <th>إجراء</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($Allcategory as $cate)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $cate->name }}</td>
                                    <td>
                                        @if($cate->statue === 1)
                                            <span class="badge rounded-pill badge-light-primary me-1">مفعل</span>
                                        @else 
                                            <span class="badge rounded-pill badge-light-danger me-1">غير مفعل</span>
                                        @endif
                                    </td>
                                    <td>
                                        <div class="dropdown">
                                            <button type="button" class="btn btn-sm dropdown-toggle hide-arrow py-0 waves-effect waves-float waves-light" data-bs-toggle="dropdown" aria-expanded="false">
                                                <i data-feather="more-vertical"></i>
                                            </button>
                                            <div class="dropdown-menu dropdown-menu-end">
                                                <a class="dropdown-item editBtn" href="#" data-id="{{ $cate->id }}" data-name="{{ $cate->name }}" data-bs-toggle="modal" data-bs-target="#UpdateModel"> 
                                                    <i data-feather="edit-2" class="me-50"></i>
                                                    <span>تعديل</span>
                                                </a>
                                                <a class="dropdown-item delBtn" href="#" data-id="{{ $cate->id }}" data-bs-toggle="modal" data-bs-target="#DelModel">
                                                    <i data-feather="trash" class="me-50"></i>
                                                    <span>حذف</span>
                                                </a>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr class="text-center">
                                    <td colspan="4">لا توجد اى اقسام مضافة</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>


        <!-- models action -->
        @include('dashboard.category.models')

    </section>
@endsection

@section('js')
<script>
    $(".editBtn").on('click', function(){
        let cate_id = $(this).attr('data-id')
        let cate_name = $(this).attr('data-name')

        $("#UpdateModel .id").val(cate_id);
        $("#UpdateModel .name").val(cate_name);
    })

    $(".delBtn").on('click', function(){
        let cate_id = $(this).attr('data-id')

        $("#DelModel .cate_id").val(cate_id);
    })
</script>
@endsection