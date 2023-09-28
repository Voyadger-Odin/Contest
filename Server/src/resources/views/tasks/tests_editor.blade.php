
@extends('layout.main')

@section('title')
    Contest
@endsection

<!-- Plugin css for this page -->
@section('plugin_css_for_this_page')
    <link rel="stylesheet" href="{{asset('assets/vendors/markdown-it/markdown-it.css')}}">
    <link rel="stylesheet" href="{{asset('assets/css/task-info.css')}}">
    <link rel="stylesheet" href="{{asset('assets/vendors/codemirror/codemirror.css')}}">
@endsection
<!-- End Plugin css for this page -->

@section('body')
    <div class="main-panel">
        <div class="pricing-header px-3 py-3 pt-md-5 pb-md-4 mx-auto text-center">
            <h1 class="display-4">Редактор тестов</h1>
            <p class="lead">
                @if($tasksSelectedGroup == null and $taskSelected == null)
                    Создавайте задания для своей компании, чтобы лучше отбирать и тестировать персонал
                @elseif($tasksSelectedGroup != null and $taskSelected == null)
                    {{$tasksSelectedGroup->title}}
                @elseif($tasksSelectedGroup != null and $taskSelected != null)
                    {{$taskSelected->title}} ({{$tasksSelectedGroup->title}})
                @endif
            </p>
        </div>

        <div class="content-wrapper" style="width: 100vw">
            <div class="row">
                <!-- Groups list -->
                <div class="col-xl-2 col-sm-6 grid-margin stretch-card">
                    <div class="content-wrapper">
                        <!-- Tasks -->
                        @if($tasksSelectedGroup != null)
                            @include('tasks.include.tasks-editor-tasks-list')
                        @endif
                        <!-- End tasks -->

                        <!-- Tasks group -->
                        @include('tasks.include.tasks-editor-tasks-group-list')
                        <!-- End tasks group -->
                    </div>
                </div>
                <!-- End groups list -->

                <!-- Editor -->
                <div class="col-xl-9 col-sm-6 grid-margin stretch-card">
                    <div class="content-wrapper">

                        @if($tasksSelectedGroup != null and $taskSelected == null)
                            <!-- Edit tasks group -->
                            @include('tasks.include.task-editor-tasks-group')
                        @elseif($tasksSelectedGroup != null and $taskSelected != null)
                            <!-- Edit task -->
                            @include('tasks.include.task-editor-task')
                        @endif
                    </div>
                </div>
                <!-- End editor -->
            </div>
        </div>
    </div>
@endsection



<!-- Plugin js for this page -->
@section('plugin_js_for_this_page')
    <script src="{{asset('assets/js/main.js')}}"></script>

    @if($tasksSelectedGroup != null and $taskSelected == null)
    <!-- Edit tasks group -->
    <script src="{{asset('assets/js/tasks-editor/edit-group.js')}}"></script>
    <!-- End edit tasks group -->
    @endif

    @if($tasksSelectedGroup != null and $taskSelected != null)
    <!-- Edit task -->

    <!-- CodeMirror -->
    <script src="{{asset('assets/vendors/codemirror/codemirror.js')}}"></script>
    <!-- mode -->
    <script src="{{asset('assets/vendors/codemirror/mode/javascript/javascript.js')}}"></script>
    <script src="{{asset('assets/vendors/codemirror/mode/markdown/markdown.js')}}"></script>

    <!-- MarkDown -->
    <script src="{{asset('assets/vendors/markdown-it/markdown-it.min.js')}}"></script>
    <script id="MathJax-script" src="{{asset('assets/vendors/mathjax/math-jax.js')}}"></script>


    <!--<script type="text/javascript" src="http://cdn.mathjax.org/mathjax/latest/MathJax.js?config=TeX-AMS_HTML"></script>-->


    <script src="{{asset('assets/js/tasks-editor/edit-task.js')}}"></script>
    <!-- End edit task -->
    @endif
@endsection
<!-- End plugin js for this page -->
