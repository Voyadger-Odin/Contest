
@extends('layout.main')

@section('title')
    Contest
@endsection

<!-- Plugin css for this page -->
@section('plugin_css_for_this_page')

@endsection
<!-- End Plugin css for this page -->

@section('body')
    <div class="main-panel align-items-center">
        <div class="pricing-header px-3 py-3 pt-md-5 pb-md-4 mx-auto text-center">
            <h1>Contest</h1>
            <p class="lead">Создавайте задания для своей компании, чтобы лучше отбирать и тестировать персонал</p>
        </div>

        <div class="content-wrapper" style="width: 80vw">
            <!-- Решение задания на программирование -->
            <div class="row">
                <div class="col-xl-6 col-sm-6 grid-margin stretch-card">
                    <div class="content-wrapper">
                        <h2>Решение задания на программирование</h2>
                        <p>Решение задания на программирования. Отображается описания из MarkDown. Есть выбор языка с соответствующей подсветкой. Внизу есть список с предыдущими решениями, их статусе выполнения, содержанием.</p>
                    </div>
                </div>

                <div class="col-xl-6 col-sm-6 grid-margin stretch-card">
                    <div class="content-wrapper">
                        <video style="width: 100%" controls="controls">
                            <source src="{{asset('assets/video/A+B.webm')}}">
                        </video>
                    </div>
                </div>
            </div>

            <!-- Создание / редактирование задания -->
            <div class="row">
                <div class="col-xl-6 col-sm-6 grid-margin stretch-card">
                    <div class="content-wrapper">
                        <video style="width: 100%" controls="controls">
                            <source src="{{asset('assets/video/task-edit.webm')}}">
                        </video>
                    </div>
                </div>

                <div class="col-xl-6 col-sm-6 grid-margin stretch-card">
                    <div class="content-wrapper">
                        <h2>Создание / редактирование задания</h2>
                        <p>При редактировании задания, можно сразу видеть, как оно будет отображаться в правой части окна. Редактор подсвечивает синтаксис. Если при заполнении тестов допустить ошибку, редактор укажет на неё максимально информативно и не даст сохранить некорректное заполнение.</p>
                    </div>
                </div>
            </div>

            <!-- MarkDown + LaTeX -->
            <div class="row">
                <div class="col-xl-6 col-sm-6 grid-margin stretch-card">
                    <div class="content-wrapper">
                        <h2>MarkDown + LaTeX</h2>
                        <p>Пример отображение различных тегов MarkDown, а также формул</p>
                    </div>
                </div>

                <div class="col-xl-6 col-sm-6 grid-margin stretch-card">
                    <div class="content-wrapper">
                        <video style="width: 100%" controls="controls">
                            <source src="{{asset('assets/video/markdown-view.webm')}}">
                        </video>
                    </div>
                </div>
            </div>

            <!-- PDF отображение -->
            <div class="row">
                <div class="col-xl-6 col-sm-6 grid-margin stretch-card">
                    <div class="content-wrapper">
                        <video style="width: 100%" controls="controls">
                            <source src="{{asset('assets/video/PDFView.webm')}}">
                        </video>
                    </div>
                </div>

                <div class="col-xl-6 col-sm-6 grid-margin stretch-card">
                    <div class="content-wrapper">
                        <h2>PDF отображение</h2>
                        <p>Любое задание можно открыть и скачать в формате PDF. Это может быть полезно для собеседования, или в качестве раздаточного материала студентам на олимпиадах.</p>

                        <strong>НЕ ПОДДЕРЖИВАЕТ ОТОБРАЖЕНИЕ ФОРМУЛ</strong>
                    </div>
                </div>
            </div>


        </div>
    </div>
@endsection


<!-- Plugin js for this page -->
@section('plugin_js_for_this_page')

@endsection
<!-- End plugin js for this page -->
