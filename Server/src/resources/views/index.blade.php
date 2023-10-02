
@extends('layout.main')

@section('title')
    Contest
@endsection

<!-- Plugin css for this page -->
@section('plugin_css_for_this_page')
    <link rel="stylesheet" href="{{asset('assets/css/index.css')}}">
    <link rel="stylesheet" href="{{asset('assets/vendors/prism/prism-okaidia.min.css')}}">
@endsection
<!-- End Plugin css for this page -->

@section('body')
    <div class="main-panel align-items-center">
        <div class="pricing-header px-3 py-3 pt-md-5 pb-md-4 mx-auto text-center">
            <h1>{{env('APP_NAME', 'Contest')}}</h1>
            <p class="lead">Создавайте задания для своей компании, чтобы лучше отбирать и тестировать персонал</p>
        </div>

        <div class="content-wrapper" style="width: 80vw">
            <!-- Код -->
            <div class="row">
                <div class="col-xl-8 col-sm-6 grid-margin stretch-card">
                    <div class="content-wrapper">
                        <h2>Задания на программирование</h2>
                        <p>Создавайте собственные задания на программирование для ваших сотрудников или студентов. Это поможет протестировать знания, необходимые именно вам</p>
                    </div>
                </div>

                <div class="col-xl-4 col-sm-6 grid-margin stretch-card">
                    <div class="content-wrapper">
                        <pre class="language-py code-block" ><code class="js-code"></code></pre>
                    </div>
                </div>
            </div>

            <!-- Формулы -->
            <div class="row">
                <div class="col-xl-4 col-sm-6 grid-margin stretch-card">
                    <div class="content-wrapper" style="background: #f6f7f8; border-radius: 5px">
                        \begin{align*}
                        t _ { 1 } + t _ { 2 } = \frac { ( 2 L / c ) \sqrt { 1 - u ^ { 2 } / c ^ { 2 } } } { 1 - u ^ { 2 } / c ^ { 2 } } = \frac { 2 L / c } { \sqrt { 1 - u ^ { 2 } / c ^ { 2 } } }
                        \end{align*}
                    </div>
                </div>

                <div class="col-xl-8 col-sm-6 grid-margin stretch-card">
                    <div class="content-wrapper">
                        <h2>Формулы LaTeX</h2>
                        <p>Используйте математические формулы в формате LaTeX для подробного описания заданий</p>
                    </div>
                </div>
            </div>

            <!-- Код -->
            <div class="row">
                <div class="col-xl-8 col-sm-6 grid-margin stretch-card">
                    <div class="content-wrapper">
                        <h2>MarkDown</h2>
                        <p>Описывайте задания в разметке MarkDown. Экономьте время, используя удобный формат</p>
                    </div>
                </div>

                <div class="col-xl-4 col-sm-6 grid-margin stretch-card">
                    <div class="content-wrapper">
<pre>
| # |      Город      |    человек |
|:--|:---------------:|-----------:|
| 1 |     Москва      | 13 010 112 |
| 2 | Санкт-Петербург |  5 601 911 |
| 3 |   Новосибирск   |  1 633 595 |
| 4 |  Екатеринбург   |  1 588 665 |
</pre>
                    </div>
                </div>
            </div>

            <!-- Формулы -->
            <div class="row">
                <div class="col-xl-4 col-sm-6 grid-margin stretch-card">
                    <div class="content-wrapper" style="padding: 0">
                        <img src="{{asset('assets/img/pdf-view.png')}}" style="object-fit: cover !important; width: 100%; height: 200px; border-radius: 5px">
                    </div>
                </div>

                <div class="col-xl-8 col-sm-6 grid-margin stretch-card">
                    <div class="content-wrapper">
                        <h2>Экспорт в PDF</h2>
                        <p>Экспортируйте заданий в PDF. Удобно распечатывайте и показывайте на собеседованиях или раздавайте студентам на контрольных или олимпиадах (PDF не поддерживает отображение формул)</p>
                    </div>
                </div>
            </div>

            <!-- Используемые технологии -->
            <div class="row">
                <div class="col-xl-12 col-sm-6 grid-margin stretch-card">
                    <div class="content-wrapper">
                        <h2>Технологии и инструменты</h2>
                    </div>
                </div>
            </div>

            <?php
                $technologies = [
                    [
                        'name' => 'Docker',
                        'img' => asset('assets/img/technologies/docker-logo.png'),
                        'link' => 'https://www.docker.com/',
                    ],
                    [
                        'name' => 'Docker compose',
                        'img' => asset('assets/img/technologies/docker-compose.png'),
                        'link' => 'https://docs.docker.com/compose/',
                    ],
                    [
                        'name' => 'Laravel',
                        'img' => asset('assets/img/technologies/Laravel-Logo.png'),
                        'link' => 'https://laravel.com/',
                    ],
                    [
                        'name' => 'Flask',
                        'img' => asset('assets/img/technologies/flask-logo.png'),
                        'link' => 'https://flask.palletsprojects.com/',
                    ],
                    [
                        'name' => 'PhpStorm',
                        'img' => asset('assets/img/technologies/PhpStorm-logo.png'),
                        'link' => 'https://www.jetbrains.com/phpstorm/',
                    ],
                    [
                        'name' => 'PyCharm',
                        'img' => asset('assets/img/technologies/PyCharm-logo.png'),
                        'link' => 'https://www.jetbrains.com/ru-ru/pycharm/',
                    ],
                    [
                        'name' => 'Postman',
                        'img' => asset('assets/img/technologies/postman-icon.png'),
                        'link' => 'https://www.postman.com/',
                    ],
                    [
                        'name' => 'MySQL',
                        'img' => asset('assets/img/technologies/logo-mysql.png'),
                        'link' => 'https://www.mysql.com/',
                    ],
                    [
                        'name' => 'Bootstrap',
                        'img' => asset('assets/img/technologies/bootstrap-logo.svg'),
                        'link' => 'https://getbootstrap.com/',
                    ],
                    [
                        'name' => 'Swagger',
                        'img' => asset('assets/img/technologies/Swagger-logo.png'),
                        'link' => 'https://swagger.io/',
                    ],
                    [
                        'name' => 'CodeMirror',
                        'img' => asset('assets/img/technologies/codemirror-icon.svg'),
                        'link' => 'https://codemirror.net/',
                    ],
                    [
                        'name' => 'JSON',
                        'img' => asset('assets/img/technologies/JSON_vector_logo.png'),
                        'link' => 'https://www.json.org/',
                    ],
                    [
                        'name' => 'Markdown',
                        'img' => asset('assets/img/technologies/Markdown-mark.png'),
                        'link' => 'https://www.markdownguide.org/',
                    ],
                    [
                        'name' => 'markdown-it',
                        'img' => asset('assets/img/technologies/github-mark.png'),
                        'link' => 'https://github.com/markdown-it/markdown-it',
                    ],
                    [
                        'name' => 'markdown-it-php',
                        'img' => asset('assets/img/technologies/github-mark.png'),
                        'link' => 'https://github.com/kaoken/markdown-it-php',
                    ],
                    [
                        'name' => 'MathJax',
                        'img' => asset('assets/img/technologies/MathJax-logo.png'),
                        'link' => 'https://www.mathjax.org/',
                    ],
                    [
                        'name' => 'DOMPDF',
                        'img' => asset('assets/img/technologies/github-mark.png'),
                        'link' => 'https://github.com/barryvdh/laravel-dompdf',
                    ],

                ];
            ?>


            <div class="row">
                @foreach($technologies as $technology)
                    <div class="col-xl-2 ">
                        <div class="content-wrapper technologies-card">
                            <div class="card">
                                <a href="{{$technology['link']}}" target="_blank">
                                    <div class="card-body">
                                        <div class="row align-items-center">
                                            <img src="{{$technology['img']}}" class="logo-brand">
                                        </div>
                                        <br>
                                        <h6 class="text-muted font-weight-normal text-center text-brand">{{$technology['name']}}</h6>
                                    </div>
                                </a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>

    </div>
@endsection


<!-- Plugin js for this page -->
@section('plugin_js_for_this_page')

    <!-- Prism -->
    <script src="{{asset('assets/vendors/prism/prism.min.js')}}"></script>
    <script src="{{asset('assets/vendors/prism/prism-python.min.js')}}"></script>

    <!-- MathJax -->
    <script id="MathJax-script" src="{{asset('assets/vendors/mathjax/math-jax.js')}}"></script>

    <script id="MathJax-script" src="{{asset('assets/js/index/index.js')}}"></script>
@endsection
<!-- End plugin js for this page -->
