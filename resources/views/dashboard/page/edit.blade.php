@extends('layouts.dashboard')

@section('css')
<link href="https://cdn.quilljs.com/1.3.6/quill.snow.css" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.9.3/min/dropzone.min.css">
@endsection

@section('page-header')
<div class="content-header row">
    <div class="content-header-left col-md-9 col-12 mb-2">
        <div class="row breadcrumbs-top">
            <div class="col-12">
                <h2 class="content-header-title float-start mb-0">تعديل الصفحة</h2>
                <div class="breadcrumb-wrapper">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">الرئيسية</a>
                        </li>
                        <li class="breadcrumb-item"><a href="#">{{ $page->title }}</a>
                        </li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    <div class="content-header-right text-md-end col-md-3 col-12">
        <div class="mb-1 breadcrumb-right">
            <a class="btn btn-primary waves-effect waves-float waves-light" href="{{ route('page.view') }}">رجوع</a>
        </div>
    </div>
</div>
@endsection

@section('content')
    <section id="blogView">
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

        <div class="blog-Form">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <!-- show page Form -->
                       <div class="col-md-12">
                            <form class="formBlog" action="{{ route('page.update') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <input type="hidden" value="{{ $page->id }}" name="id">
                                {{-- عنوان المقال --}}
                                <div class="mb-2">
                                    <label for="title" class="form-label">عنوان الصفحة</label>
                                    <input type="text" id="title" name="title" class="form-control" value="{{ $page->title }}" required>
                                </div>
        
                                {{-- عنوان الرئيسية --}}
                                <div class="mb-2">
                                    <label for="main_image" class="form-label">الصورة الرئيسية</label>
                                    <input type="file" id="main_image" name="main_image" class="form-control" accept="image/*" value="{{ old('title') }}">
                                </div>
        
                                {{-- مكان الظهور --}}
                                <div class="mb-2">
                                    <label for="location" class="form-label">مكان الظهور</label>
                                    <select name="location" id="location" class="form-select">
                                        <option value="{{ $page->location }}">{{ $page->location }}</option>
                                        <option value="headerTop">headerTop </option>
                                        <option value="Footer">Footer</option>
                                        <option value="NewsPaper">NewsPaper</option>
                                    </select>
                                </div>
        
        
                                {{-- محتوى المقال  --}}
                                <div class="mb-3">
                                    <label for="content">المحتوى</label>
                                    <div id="editor-container">
                                    </div>
                                    <input type="hidden" name="content" id="content">
                                    <input type="hidden" name="images" id="images">
                                </div>

                                <div class="mb-1">
                                    <label class="form-label">رفع ملفات pdf</label>
                                    <input type="file" name="files[]" class="form-control pdfFiles" accept="application/pdf" multiple>
                                    <div id="pdf-dropzone" class="dropzone mt-2"></div>
                                    <input type="hidden" name="uploaded_files" id="uploaded_files">
                                </div>
        
                                <button type="submit" class="btn btn-relief-primary">حفظ الصفحة</button>
                
                            </form>
                       </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="previewImages">
            <div class="card">
                <div class="card-header">
                    <h3>عرض ملفات pdf</h3>
                </div>
                <div class="card-body">
                    <table class="table table-bordered">
                        <tr>
                            <td>اسم الملف</td>
                            <td>الملف</td>
                            <td>حذف</td>
                        </tr>
                        @foreach($page->files as $file)
                            <tr>
                                <td>{{ $file->fileName }}</td>
                                <td>
                                    <a href="{{ route('file.download', $file->id) }}" class="btn btn-success waves-effect waves-float waves-light">
                                        تحميل الملف
                                    </a>
                                </td>
                                <td>
                                    <a class="btn btn-danger waves-effect waves-float waves-light delBtn" href="#" data-id="{{ $file->id }}" data-bs-toggle="modal" data-bs-target="#DelModelFile">
                                        <i data-feather="trash" class="me-50"></i>
                                        <span>حذف</span>
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    </table>
                </div>
            </div>
        </div>

    </section>
    <!-- model delete -->
    @include('dashboard.page.Mdel')
@endsection

@section('js')
<script src="https://cdn.quilljs.com/1.3.6/quill.min.js" type="text/javascript"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.9.3/min/dropzone.min.js"></script>
<script>

// إعداد محرر Quill
var quill = new Quill("#editor-container", {
    theme: "snow",
    modules: {
        toolbar: {
            container: [
                [{ header: [1, 2, false] }],
                ["bold", "italic", "underline"],
                [{ list: "ordered" }, { list: "bullet" }],
                ["image"],
                ["pdf"],
                [{ 'direction': 'rtl' }],
                [{ align: '' }, { align: 'center' }, { align: 'right' }, { align: 'justify' }]
            ],
            handlers: {
                image: function () {
                    let input = document.createElement("input");
                    input.setAttribute("type", "file");
                    input.setAttribute("multiple", "true"); // السماح برفع عدة صور
                    input.setAttribute("accept", "image/*");

                    input.addEventListener("change", function () {
                        let files = input.files;
                        let formData = new FormData();

                        for (let i = 0; i < files.length; i++) {
                            formData.append("images[]", files[i]); // إضافة جميع الصور في الطلب
                        }

                        fetch("/upload-images", {
                            method: "POST",
                            body: formData,
                            headers: {
                                "X-CSRF-TOKEN": document
                                    .querySelector('meta[name="csrf-token"]')
                                    .getAttribute("content"),
                            },
                        })
                            .then((response) => response.json())
                            .then((data) => {
                                if (data.images) {
                                    data.images.forEach((imageUrl) => {
                                        let range = quill.getSelection();
                                        quill.insertEmbed(range.index, "image", imageUrl);
                                    });
                                } else {
                                    alert("حدث خطأ أثناء رفع الصور!");
                                }
                            })
                            .catch((error) => console.error("Error:", error));
                    });

                    input.click();
                },
                pdf: function () {
                    let input = document.createElement("input");
                    input.setAttribute("type", "file");
                    input.setAttribute("accept", "application/pdf");

                    input.addEventListener("change", function () {
                        let file = input.files[0];
                        let formData = new FormData();
                        formData.append("pdf", file);

                        fetch("/upload-pdf", {
                            method: "POST",
                            body: formData,
                            headers: {
                                "X-CSRF-TOKEN": document
                                    .querySelector('meta[name="csrf-token"]')
                                    .getAttribute("content"),
                            },
                        })
                            .then((response) => response.json())
                            .then((data) => {
                                if (data.pdfUrl) {
                                let range = quill.getSelection();
                                quill.clipboard.dangerouslyPasteHTML(range.index, data.html);                            
                            } 
                            else {
                                    alert("حدث خطأ أثناء رفع الملف!");
                            }
                            })
                            .catch((error) => console.error("Error:", error));
                    });

                    input.click();
                }
            },
        },
    },
});

$(function(){

    // تحميل المحتوى القديم للمقالة من Laravel
    const oldContent = {!! json_encode($page->content) !!};
    quill.root.innerHTML = oldContent; // وضع المحتوى داخل محرر Quill

    document.querySelector('.formBlog').addEventListener('submit', function (event) {
        event.preventDefault(); // منع الإرسال الافتراضي

        // الحصول على محتوى المحرر
        let contentInput = document.getElementById('content');
        let imagesInput = document.getElementById('images');
        let quillContent = quill.root.innerHTML;

        // استخراج جميع الصور من المحرر
        let parser = new DOMParser();
        let doc = parser.parseFromString(quillContent, "text/html");
        let imageElements = doc.querySelectorAll("img");

        let imageUrls = [];
        imageElements.forEach(img => {
            imageUrls.push(img.src); // حفظ روابط الصور
        });

        // تحديث الحقول المخفية
        contentInput.value = quillContent;
        imagesInput.value = JSON.stringify(imageUrls); // تخزين الصور كمصفوفة JSON

        console.log("محتوى المقال:", contentInput.value);
        console.log("روابط الصور:", imagesInput.value);

        this.submit(); // إرسال النموذج بعد تحديث الحقول
    });

})

$(".delBtn").on('click', function(){
    let id = $(this).attr('data-id')
    $("#DelModelFile .id").val(id);
});

// upload drop drag

Dropzone.autoDiscover = false;

var uploadedFiles = [];

var dropzone = new Dropzone("#pdf-dropzone", {
    url: "{{ route('page.upload') }}",
    paramName: "file",
    maxFiles: 100,
    maxFilesize: 5, // الحجم الأقصى للملف بـ ميجابايت
    acceptedFiles: "application/pdf",
    headers: {
        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
    },
    success: function(file, response) {
        uploadedFiles.push(response.file_name);
        document.getElementById('uploaded_files').value = JSON.stringify(uploadedFiles);
    },
    error: function(file, response) {
        console.error("Error uploading file:", response);
    }
});


</script>
@endsection