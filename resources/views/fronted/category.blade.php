@extends('layouts.guest')

@section('page-title')
المصور التركي التويجرى
@endsection

@section('content')

<section id="elnawader_wedding">
    <div class="container">
            <h3 class="heading_category">
                <a class="link" href="#">
                    {{ $cate_name }}
                </a>
            </h3>
            <div class="elnawader_box">
                <div class="row">
                    @foreach($getBlogLast as $blog)
                            <div class="col-md-4">
                                <div class="card">
                                    <div class="card-image">
                                        <a class="link" href="{{ route('blogView', $blog->id) }}">
                                            <img src="{{ asset($blog->main_image) }}" alt="{{ $blog->title }}">
                                        </a>
                                    </div>
                                    <div class="card-body">
                                        <a class="link" href="{{ route('blogView', $blog->id) }}">
                                            <h3>{{ $blog->title }}</h3>
                                        </a>
                                    </div>
                                    <div class="card-footer">
                                        <span>{{ \Carbon\Carbon::parse($blog->created_at)->format('d/m/Y')}}</span>
                                    </div>
                                </div>
                            </div>
                    @endforeach
                </div>
            </div>
    </div>
</section>

@endsection


