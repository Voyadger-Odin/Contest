<?php

use Illuminate\Support\Facades\Auth;
$user = Auth::user();

?>


@extends('layout.main')

@section('title')
    Список заданий
@endsection

@section('body')
        <div class="pricing-header px-3 py-3 pt-md-5 pb-md-4 mx-auto text-center">
            <h1 class="display-4">Тесты</h1>
            <p class="lead">Создавайте задания для своей компании, чтобы лучше отбирать и тестировать персонал</p>
        </div>


        <div class="content-wrapper">
            <div class="row">
                <!-- Test -->
                @foreach($tasksGroups as $tasksGroup)
                    <div class="col-xl-3 col-sm-6 grid-margin stretch-card">
                        <div class="card">
                            <?php
                                $task_group_first = $tasksGroup->tasks()->first();
                                $task_first_id = ($task_group_first) ? $task_group_first->id : '';
                            ?>

                            @if($task_group_first)
                                <a href="{{route('task', $task_first_id)}}">
                            @endif
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-9">
                                            <div class="d-flex align-items-center align-self-start">
                                                <h3 class="mb-0">
                                                    @if($user->role == 'admin')
                                                        @if($tasksGroup->active)
                                                            @include('include.components.eye-active')
                                                        @else
                                                            @include('include.components.eye-unactive')
                                                        @endif
                                                    @endif
                                                    {{$tasksGroup->title}}
                                                </h3>
                                            </div>
                                        </div>
                                        <div class="col-3">
                                            <img class="test-icon" src="{{$tasksGroup->img}}">
                                        </div>
                                    </div>
                                    <h6 class="text-muted font-weight-normal">Решено тестов {{$tasksGroup->getCompletedTasks($user->id)->count()}} из {{$tasksGroup->tasks()->get()->count()}}</h6>
                                </div>
                            @if($task_group_first)
                                </a>
                            @endif
                        </div>
                    </div>
                @endforeach
                <!-- End test -->
            </div>
        </div>
        <!-- content-wrapper ends -->
@endsection
