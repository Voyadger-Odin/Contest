@extends('layout.main')

@section('title')
    Регистрация
@endsection

@section('body')

    <div class="container-scroller">
        <div class="container-fluid page-body-wrapper full-page-wrapper">
            <div class="row w-100 m-0">
                <div class="content-wrapper full-page-wrapper d-flex align-items-center auth login-bg">
                    <div class="card col-lg-4 mx-auto">
                        <div class="card-body px-5 py-5">
                            <h3 class="card-title text-left mb-3">Регистрация</h3>
                            <form method="post" action="{{route('register')}}">
                                @csrf
                                <div class="form-group">
                                    <label>Username</label>
                                    <input type="text" name="name" class="form-control p_input">
                                </div>
                                <div class="form-group">
                                    <label>Email</label>
                                    <input type="text" name="email" class="form-control p_input">
                                </div>
                                <div class="form-group">
                                    <label>Password</label>
                                    <input type="password" name="password" class="form-control p_input">
                                </div>
                                <div class="text-center">
                                    <button type="submit" class="btn btn-light btn-block enter-btn">Регистрация</button>
                                </div>
                                <p class="sign-up text-center">Уже есть аккаунт? <a href="{{route('login')}}">Войти</a></p>
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
