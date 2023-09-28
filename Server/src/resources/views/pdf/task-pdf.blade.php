<?php

use \Kaoken\MarkdownIt\MarkdownIt;
$md = new MarkdownIt();
?>


    <!DOCTYPE html>
<html lang="ru">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>{{$task->title}}</title>

    <style>

    </style>

    <!-- Plugin css for this page -->
    @include('pdf.style.style')
    @include('pdf.style.task-info')
    @include('pdf.style.markdown-it')

    <link rel="icon" type="image/x-icon" href="{{asset('assets/img/Contest.ico')}}">
</head>
<body>
<center>
    <h1 class="text-center h1-pdf">
        {{$task->title}}
    </h1>
</center>

<br>

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

<div class="MarkDownWindow">
    <?php
    $result = $md->render($task->description);
    echo $result;
    ?>
</div>
</body>
</html>
