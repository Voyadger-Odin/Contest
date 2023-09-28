<h5>Тесты ({{$tasksSelectedGroup->title}})</h5>

<form method="POST" action="{{route('newTask')}}">
    @csrf
    <input type="hidden" name="task_group" value="{{$tasksSelectedGroup->id}}">
    <button type="submit" class="btn btn-link" style="font-size: 14pt">Добавить тест</button>
</form>
<?php
$task_number = 0;
?>
@foreach($tasksSelectedGroup->tasks()->get() as $task)
        <?php
        $task_number += 1
        ?>
    <a href="{{route('tasks_editor', [$tasksSelectedGroup->id, $task->id])}}">
        {{$task_number}}.
        @if($task->active)
            @include('include.components.eye-active')
        @else
            @include('include.components.eye-unactive')
        @endif
        {{$task->title}}
    </a>
    <br>
@endforeach
<br><br>
