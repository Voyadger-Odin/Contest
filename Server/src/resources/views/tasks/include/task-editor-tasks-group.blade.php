<form method="POST" action="{{route('tasks_groups', $tasksSelectedGroup->id)}}">
    <input type="hidden" name="_method" value="put" />
    @csrf

    <div class="form-check" style="">
        <input name="tasksGroupActive" type="checkbox" class="form-check-input" id="exampleCheck1" @if($tasksSelectedGroup->active) checked @endif>
        <label class="form-check-label" for="exampleCheck1">Активный</label>
    </div>

    <br>

    <label for="basic-url">Название</label>
    <input type="text" name="tasksGroupTitle" class="form-control" value="{{$tasksSelectedGroup->title}}">

    <br>

    <label for="basic-url">Картинка</label>
    <input type="text" name="tasksGroupImg" oninput="inputIMG(this.value)" class="form-control" value="{{$tasksSelectedGroup->img}}">

    <br>
    <img id="tasks-group-img" class="test-icon" src="{{$tasksSelectedGroup->img}}">

    <br><br>

    <button type="submit" class="btn btn-light">Сохранить</button>
    <button onclick="deleteTasksGroup('{{$tasksSelectedGroup->title}}', '{{csrf_token()}}', '{{route('deleteTasksGroups', $tasksSelectedGroup->id)}}')" type="button" class="btn btn-danger">Удалить</button>
</form>

