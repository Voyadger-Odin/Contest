
@extends('layout.main')

@section('title')
    Компиляторы и значения ошибок
@endsection

<?php
$PAGE_SELECTED = 'info'
?>

@section('body')
<div class="pricing-header px-3 py-3 pt-md-5 pb-md-4 mx-auto text-center">
    <h1>Компиляторы и значения ошибок</h1>
</div>

<div class="content-wrapper" style="width: 70vw">
    <div class="row">
        <div class="col-xl-9 col-sm-6 grid-margin stretch-card">
            <div class="content-wrapper">
                <h1>Настройки компиляторов</h1>
                <table class="table">
                    <thead>
                    <tr>
                        <th scope="col">Язык</th>
                        <th scope="col">Компиляция</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach(GetCompilersInfo() as $compiler)
                        <tr>
                            <td>{{$compiler['language-name']}} - {{$compiler['language-version']}}</td>
                            <td>{{$compiler['compiler-name']}}</td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>

                <br><br>

                <h1>Значения ошибок</h1>
                <table class="table">
                    <thead>
                    <tr>
                        <th scope="col">Ошибка</th>
                        <th scope="col">Значение</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <td>In process</td>
                        <td>Решается</td>
                    </tr>
                    <tr>
                        <td>OK</td>
                        <td>Решена</td>
                    </tr>
                    <tr>
                        <td>Runtime error</td>
                        <td>Ошибка во время выполнения (или при компиляции)</td>
                    </tr>
                    <tr>
                        <td>Timeout error</td>
                        <td>Решается дольше положенного времени</td>
                    </tr>
                    <tr>
                        <td>Wrong answer</td>
                        <td>В одном из тестов неправильный ответ</td>
                    </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
