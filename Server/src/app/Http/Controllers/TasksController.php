<?php

namespace App\Http\Controllers;

use App\Models\TasksGroup;
use Illuminate\Support\Facades\Auth;

class TasksController extends Controller
{

    // Получить список групп тестов
    public function tasksGroupList()
    {
        $tasksGroups = getTasksGroupList(Auth::user()->role === 'admin');

        return view('tasks.tasks', [
            'tasksGroups' => $tasksGroups,
        ]);
    }

    public function task($task_id)
    {
        $task = getTask($task_id);
        if ($task == null){
            return redirect('tasks');
        }
        $taskGroup = $task->taskGroup()->first();

        if ((Auth::user()->role !== 'admin') and (
            !($task->active) or !($taskGroup->active)
            )
        ){
            return redirect()->to(route('tasks'));
        }

        $tests = getTaskTests($task);

        return view('tasks.task', [
            'task' => $task,
            'taskGroup' => $taskGroup,
            'maxtime' => $tests->maxtime,
            'memory_size' => $tests->memory_size,
        ]);
    }

    public function tasksEditor($task_group_id = null, $task_id=null)
    {

        $tasksGroups = TasksGroup::all();

        $tasksSelectedGroup = null;
        if ($task_group_id != null){
            $tasksSelectedGroup = getTasksGroup($task_group_id);
        }

        $taskSelected = null;
        if ($task_id != null){
            $taskSelected = getTask($task_id);
        }

        return view('tasks.tests_editor', [
            'tasksGroups' => $tasksGroups,
            'tasksSelectedGroup' => $tasksSelectedGroup,
            'taskSelected' => $taskSelected,
        ]);
    }

    // Editor

    // Сохранить / Обновить группу заданий
    public function saveTasksGroup($task_group_id)
    {
        saveTasksGroup(
            $task_group_id,
            boolval(request('tasksGroupActive')),
            request('tasksGroupTitle'),
            request('tasksGroupImg')
        );
        return redirect()->back();
    }

    // Сохранить / Обновить задание
    public function saveTasks($task_id)
    {
        saveTask(
            $task_id,
            boolval(request('taskActive')),
            request('taskTitle'),
            request('taskDescription'),
            request('taskTest')
        );
        return boolval(request('taskActive'));
    }

    public function newTask()
    {
        newTask();
        return redirect()->back();
    }

    public function newTasksGroup()
    {
        newTasksGroup();
        return redirect()->back();
    }

    public function deleteTask($task_id)
    {

        $resultDelete = deleteTask($task_id);
        if (!$resultDelete){
            $result = ['response' => 'Task not found'];
            return response($result, 500)
                ->header('Content-Type', 'text/json');
        }

        $result = ['response' => 'ok'];
        return response($result, 200)
            ->header('Content-Type', 'text/json');
    }

    public function deleteTasksGroup($task_group_id)
    {
        $resultDelete = deleteTasksGroup($task_group_id);
        if (!$resultDelete){
            $result = ['response' => 'Task not found'];
            return response($result, 500)
                ->header('Content-Type', 'text/json');
        }

        $result = ['response' => 'ok'];
        return response($result, 200)
            ->header('Content-Type', 'text/json');
    }

    public function taskPdf($task_id)
    {
        getTaskPdf($task_id);
    }
}
