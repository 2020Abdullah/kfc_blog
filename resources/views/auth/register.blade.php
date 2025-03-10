@extends('layouts.Auth')

@section('content')
<div class="bubble"></div>
<div class="bubble"></div>
<div class="bubble"></div>
<div class="auth-wrapper auth-basic px-2">
    <div class="auth-inner my-2">
        <!-- register basic -->
        <div class="card mb-0">
            <div class="card-body">
                <x-logo-component />
                <form class="auth-login-form mt-2" action="{{ route('register') }}" method="POST">
                    @csrf

                    <div class="mb-1">
                        <label for="student-name" class="form-label">اسمك بالكامل</label>
                        <input type="text" class="form-control" id="student-name" name="name" autofocus />
                    </div>
                    @error('name')
                        <div class="alert alert-danger">
                            <p>{{ @$message }}</p>
                        </div>
                    @enderror
                    

                    <div class="mb-1">
                        <label for="login-email" class="form-label">البريد الإلكتروني</label>
                        <input type="text" class="form-control" id="login-email" name="email" placeholder="AAAA@gmail.com" autofocus />
                    </div>

                    @error('email')
                        <div class="alert alert-danger">
                            <p>{{ @$message }}</p>
                        </div>
                    @enderror

                    <div class="mb-1">
                        <label class="form-label" for="login-password"> كلمة السر</label>
                        <div class="input-group input-group-merge form-password-toggle">
                            <input type="password" name="password" class="form-control form-control-merge" id="login-password" name="login-password" tabindex="2" placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;" aria-describedby="login-password" />
                            <span class="input-group-text cursor-pointer"><i data-feather="eye"></i></span>
                        </div>
                        @error('email')
                            <div class="alert alert-danger">
                                <p>{{ @$message }}</p>
                            </div>
                        @enderror
                    </div>

                    <div class="mb-1">
                        <label class="form-label" for="login-password">تأكيد كلمة السر</label>
                        <div class="input-group input-group-merge form-password-toggle">
                            <input type="password" name="password_confirmation" class="form-control form-control-merge" id="login-password" name="login-password" tabindex="2" placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;" aria-describedby="login-password" />
                            <span class="input-group-text cursor-pointer"><i data-feather="eye"></i></span>
                        </div>
                    </div>

                    <button type="submit" class="btn btn-success w-100" tabindex="4">إنشاء حساب</button>
                </form>

                <p class="text-center mt-2">
                    <a href="{{ route('login') }}">
                        <span> تسجيل الدخول</span>
                    </a>
                </p>

            </div>
        </div>
        <!-- /register basic -->
    </div>
</div>
@endsection



