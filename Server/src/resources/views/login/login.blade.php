
@extends('layout.main')

@section('page_info')

@endsection

@section('title')
    Логин
@endsection

@section('body')
    <div class="container-scroller">
        <div class="container-fluid page-body-wrapper full-page-wrapper">
            <div class="row w-100 m-0">
                <div class="content-wrapper full-page-wrapper d-flex align-items-center auth login-bg">
                    <div class="card col-lg-4 mx-auto">
                        <div class="card-body px-5 py-5">
                            <h3 class="card-title text-left mb-3">Авторизация</h3>
                            <form method="post" action="{{route('login')}}">
                                @csrf
                                @if(request()->get('url_from') != null)
                                    <input type="hidden" name="url_from" value="{{request()->get('url_from')}}">
                                @endif
                                <div class="form-group">
                                    <label>Username or email *</label>
                                    <input type="text" name="email" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label>Password *</label>
                                    <input type="password" name="password" class="form-control p_input">
                                </div>
                                <div class="text-center">
                                    <button type="submit" class="btn btn-primary btn-block enter-btn">Войти</button>
                                </div>
                                <p class="sign-up">Нет аккаунта? <a href="{{route('register')}}">Регистрация</a></p>
                            </form>
                        </div>
                    </div>
                </div>
                <!-- content-wrapper ends -->
            </div>
            <!-- row ends -->
        </div>
        <!-- page-body-wrapper ends -->
    </div>
@endsection
