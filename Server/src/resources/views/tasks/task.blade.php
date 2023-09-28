<?php

use Illuminate\Support\Facades\Auth;
$user = Auth::user();

?>

@extends('layout.main')

<!-- Plugin css for this page -->
@section('plugin_css_for_this_page')
    <link rel="stylesheet" href="{{asset('assets/vendors/codemirror/codemirror.css')}}">
    <link rel="stylesheet" href="{{asset('assets/vendors/markdown-it/markdown-it.css')}}">
    <link rel="stylesheet" href="{{asset('assets/css/task-info.css')}}">
<!-- End Plugin css for this page -->
@endsection

@section('title')
    Contest
@endsection

@section('body')

    <?php
        $tasksGroup = $taskGroup->tasks()->get();
        $lastSolution = $task->getLastSolution($user->id);
    ?>

    <div class="main-panel align-items-center">

        <div class="pricing-header px-3 py-3 pt-md-5 mx-auto text-center">

            <h1>
                @if($user->role == 'admin')
                    @if($task->active)
                        @include('include.components.eye-active')
                    @else
                        @include('include.components.eye-unactive')
                    @endif
                @endif
                {{$task->title}}

                @if($task->checkCompleted($user->id))
                    @include('include.components.checked')
                @endif
            </h1>
            <h3>
                @if($user->role == 'admin')
                    @if($taskGroup->active)
                        @include('include.components.eye-active')
                    @else
                        @include('include.components.eye-unactive')
                    @endif
                @endif
                {{$taskGroup->title}}
            </h3>
        </div>

        <div class="content-wrapper" style="width: 70vw">
            <div class="row">
                <div class="col-xl-9 col-sm-6 grid-margin stretch-card">
                    <div class="content-wrapper">

                        <div class="task-info">
                            <table class="task-info-table">
                                <thead>
                                <tr>
                                    <th>Ограничение времени</th>
                                    <th>Ограничение памяти</th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr>
                                    <td>{{$maxtime}} {{SecondsName($maxtime)}}</td>
                                    <td>{{$memory_size}} МБ</td>
                                </tr>
                                </tbody>
                            </table>
                        </div>

                        <br>

                        <div class="MarkDownWindow" id="MarkDownWindow"></div>

                        <br>

                        <?php
                            //dd($lastSolution);
                        ?>

                        <h1>Решение</h1>
                        <select name="language" id="language" class="custom-select" onchange="languageSelect(this.value)">
                            <!--<option value="">Выберите язык программирования</option>-->
                            @foreach(GetCompilersInfo() as $compiler => $compiler_data)
                                <option
                                    value="{{$compiler}}"
                                    @if($lastSolution and ($lastSolution->lang == $compiler))
                                        selected
                                    @endif
                                >
                                    {{$compiler_data['language-name']}} - {{$compiler_data['language-version']}}
                                </option>
                            @endforeach
                        </select>

                        <br><br>

                        <div class="card">
                        <textarea class="editor-area" id="editor-area">
@if($lastSolution)
{{$lastSolution->code}}@else
a = int(input())
print(a * 2)@endif
</textarea>
                        </div>
                        <br>

                        <button onclick="sendCode('{{csrf_token()}}', '{{route('send_solution')}}', {{$user->id}}, {{$task->id}})" class="btn btn-light" style="padding: 10px 20px;">Отправить</button>

                        <br><br>

                        <h4>Предыдущие решения</h4>

                        <?php
                            $previousSolutions = $user->getPreviousSolutions($task->id);
                        ?>

                        <br>
                        @if($previousSolutions->count() > 0)
                            <table class="table">
                                <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Язык</th>
                                    <th scope="col">Результат</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($previousSolutions as $solution)
                                    <tr>
                                        <th scope="row">{{$solution->id}}</th>
                                        <td>{{$solution->lang}}</td>
                                        <td>{{GetStatusName($solution->status)}}</td>
                                        <td>
                                            <button type="button" class="btn btn-link" onclick="getSolution('{{route('get_solution_result', $solution->id)}}')">
                                                Решение
                                            </button>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        @else
                            <p style="color:grey">Здесь будет список решений</p>
                        @endif
                    </div>
                </div>

                <!-- Tasks list -->
                <div class="col-xl-3 col-sm-6 grid-margin stretch-card">
                    <div class="content-wrapper">
                        <div class="row">
                            <div class="col-xl-12 grid-margin">
                                <div class="card text-center align-items-center" style="padding: 10px;">
                                    <?php
                                    $task_id = 0;
                                    ?>
                                    <h5>Выполнено: {{$taskGroup->getCompletedTasks($user->id)->count()}} из {{$tasksGroup->count()}}</h5>
                                    <div class="tasks-box">
                                        @foreach($tasksGroup as $task_group)
                                            <?php
                                                $task_id += 1;
                                            ?>


                                            <!-- Если текущие задание -->
                                            @if($task_group->id == $task->id)
                                                <div class="task-item">
                                                    <div class="icon icon-box-primary">
                                                        <span class="mdi mdi-arrow-top-right icon-item">{{$task_id}}</span>
                                                    </div>
                                                </div>
                                            <!-- Если не текущие задание -->
                                            @else
                                                <a href="/tasks/{{$task_group->id}}" class="task-item">
                                                    <div class="icon {{($task_group->checkCompleted($user->id)) ? 'icon-box-success' : 'icon-box-light'}}">
                                                        <span class="mdi mdi-arrow-top-right icon-item">{{$task_id}}</span>
                                                    </div>
                                                </a>
                                            @endif
                                        @endforeach
                                    </div>

                                    <br>
                                    <a href="{{route('info')}}" class="text-left">Компиляторы и значения ошибок</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- End tasks list -->
            </div>
        </div>


    </div>

    <!-- Modal -->
    <div class="modal fade" id="solution-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h2 class="modal-title">Решение № <span id="solution-id">5908822</span></h2>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <h3>Отчет</h3>
                    <table class="table">
                        <tbody>
                            <tr>
                                <td>Язык</td>
                                <td id="solution-language">Python - 3.11</td>
                            </tr>
                            <tr>
                                <td>Результат</td>
                                <td id="solution-status">Runtime error</td>
                            </tr>
                        </tbody>
                    </table>

                    <br><br>
                    <h3>Исходный код</h3>
                    <div class="card">
                        <textarea class="form-control" id="solution-area" readonly rows="10"></textarea>
                    </div>

                    <br><br>
                    <h3>Пройденные тесты</h3>
                    <table class="table">
                        <thead>
                        <tr>
                            <th>Тест</th>
                            <th>Результат</th>
                        </tr>
                        </thead>
                        <tbody id="solution-table-result"></tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection

<!-- Plugin js for this page -->
@section('plugin_js_for_this_page')
    <script src="{{asset('assets/js/main.js')}}"></script>


    <!-- CodeMirror -->
    <script src="{{asset('assets/vendors/codemirror/codemirror.js')}}"></script>
    <!-- mode -->
    <script src="{{asset('assets/vendors/codemirror/mode/python/python.js')}}"></script>
    <script src="{{asset('assets/vendors/codemirror/mode/clike/clike.js')}}"></script>


    <!-- MarkDown -->
    <script src="{{asset('assets/vendors/markdown-it/markdown-it.min.js')}}"></script>
    <script id="MathJax-script" src="{{asset('assets/vendors/mathjax/math-jax.js')}}"></script>

    <script>

        let markdowntext = '<?=$task->getDiscription()?>';
        let languages = {
            @foreach(GetCompilersInfo() as $compiler => $compiler_data)
                '{{$compiler}}': '{{$compiler_data['language-codemirror-name']}}',
            @endforeach
        }
        let mode = languages['{{($lastSolution) ? $lastSolution->lang : 'python-3.11'}}'];
    </script>

    <script src="{{asset('assets/js/tasks/tasks.js')}}"></script>
@endsection
<!-- End plugin js for this page -->
