<h5>Группы тестов</h5>
<form method="POST" action="{{route('newTasksGroup')}}">
    @csrf
    <button type="submit" class="btn btn-link" style="font-size: 14pt">Добавить группу</button>
</form>
@foreach($tasksGroups as $tasksGroup)
    <div class="card" style="margin-bottom: 10px">
        <a href="{{route('tasks_editor', $tasksGroup->id)}}">
            <div class="card-body" style="padding: 10px">
                <div class="row">
                    <div class="col-9">
                        <div class="d-flex align-items-center align-self-start">
                            <h5 class="mb-0">
                                @if($tasksGroup->active)
                                    @include('include.components.eye-active')
                                @else
                                    @include('include.components.eye-unactive')
                                @endif
                                {{$tasksGroup->title}}
                            </h5>
                        </div>
                    </div>
                </div>
                <h6 class="text-muted font-weight-normal" style="margin-top: 5px">Тестов: {{$tasksGroup->tasks()->get()->count()}}</h6>
            </div>
        </a>
    </div>
@endforeach
