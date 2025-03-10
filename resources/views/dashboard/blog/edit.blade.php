@extends('layouts.dashboard')

@section('css')
<link href="https://cdn.quilljs.com/1.3.6/quill.snow.css" rel="stylesheet">
@endsection

@section('page-header')
<div class="content-header row">
    <div class="content-header-left col-md-9 col-12 mb-2">
        <div class="row breadcrumbs-top">
            <div class="col-12">
                <h2 class="content-header-title float-start mb-0">تعديل الخبر</h2>
                <div class="breadcrumb-wrapper">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">الرئيسية</a>
                        </li>
                        <li class="breadcrumb-item"><a href="#">{{ $blog->title }}</a>
                        </li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    <div class="content-header-right text-md-end col-md-3 col-12">
        <div class="mb-1 breadcrumb-right">
            <a class="btn btn-primary waves-effect waves-float waves-light" href="{{ route('blog.view') }}">رجوع</a>
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

        <!-- show blog Form -->
        <div class="blog-Form">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                       <div class="col-md-12">
                            <form class="formBlog" action="{{ route('blog.update', $blog->id) }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <input type="hidden" value="{{ $blog->id }}" name="id">
                                {{-- عنوان المقال --}}
                                <div class="mb-2">
                                    <label for="title" class="form-label">عنوان الخبر</label>
                                    <input type="text" id="title" name="title" class="form-control" value="{{ $blog->title }}" required>
                                </div>
        
                                {{-- عنوان الرئيسية --}}
                                <div class="mb-2">
                                    <label for="main_image" class="form-label">الصورة الرئيسية</label>
                                    <input type="file" id="main_image" name="main_image" class="form-control" accept="image/*" value="{{ old('title') }}">
                                </div>
        
                                {{-- القسم (إن وُجد) --}}   
                                <div class="mb-2">
                                    <label for="category_id" class="form-label">القسم</label>
                                    <select name="category_id" id="category_id" class="form-select" required>
                                        <option value="">اختر القسم</option>
                                        @foreach($categories as $category)
                                            <option value="{{ $category->id }}" 
                                                {{ old('category_id', $blog->category_id) == $category->id ? 'selected' : '' }}>
                                                {{ $category->name }}
                                            </option>
                                        @endforeach
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
        
                                <button type="submit" class="btn btn-relief-primary">حفظ الخبر</button>
                
                            </form>
                       </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@section('js')
<script src="https://cdn.quilljs.com/1.3.6/quill.min.js" type="text/javascript"></script>
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
                    ["image"], // زر رفع الصور
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
                },
            },
        },
    });

    document.addEventListener("DOMContentLoaded", function () {
    // تحميل المحتوى القديم للمقالة من Laravel
    const oldContent = {!! json_encode($blog->content) !!};
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
});

</script>
@endsection