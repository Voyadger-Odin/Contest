<?php

namespace App\Http\Controllers;

use App\Models\Tasks;
use App\Models\TasksGroup;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Dompdf\Css\Stylesheet;
use Dompdf\Dompdf;
use Dompdf\FontMetrics;
use Dompdf\Options;

class TasksController extends Controller
{
    public function tasksList()
    {
        $tasksGroups = null;
        if (Auth::user()->role == 'admin'){
            $tasksGroups = TasksGroup::all();
        }else{
            $tasksGroups = TasksGroup::select()
            ->where('active', '=', true)
            ->get();
        }

        return view('tasks.tasks', [
            'tasksGroups' => $tasksGroups,
        ]);
    }

    public function task($id)
    {
        $task = Tasks::find($id);
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

        $tests = json_decode($task->tests);

        return view('tasks.task', [
            'task' => $task,
            'taskGroup' => $taskGroup,
            'maxtime' => $tests->maxtime,
            'memory_size' => $tests->memory_size,
        ]);
    }

    public function getTests($id)
    {
        $task = Tasks::find($id);
        return response($task->tests, 200)
            ->header('Content-Type', 'text/json');
    }

    public function tasksEditor($task_group = null, $task_id=null)
    {

        $tasksGroups = TasksGroup::all();

        $tasksSelectedGroup = null;
        if ($task_group != null){
            $tasksSelectedGroup = TasksGroup::find(intval($task_group));
        }

        $taskSelected = null;
        if ($task_id != null){
            $taskSelected = Tasks::find(intval($task_id));
        }

        return view('tasks.tests_editor', [
            'tasksGroups' => $tasksGroups,
            'tasksSelectedGroup' => $tasksSelectedGroup,
            'taskSelected' => $taskSelected,
        ]);
    }

    // Editor

    public function saveTasksGroup($id)
    {
        $tasksGroup = TasksGroup::find(intval($id));
        if ($tasksGroup){
            $tasksGroup->update([
                'active' => boolval(request('tasksGroupActive')),
                'title' => request('tasksGroupTitle'),
                'img' => request('tasksGroupImg'),
            ]);
        }
        return redirect()->back();
    }

    public function saveTasks($id)
    {
        $task = Tasks::find(intval($id));
        if ($task){
            $task->update([
                'active' => boolval(request('taskActive')),
                'title' => request('taskTitle'),
                'description' => request('taskDescription'),
                'tests' => request('taskTest'),
            ]);
        }
        return boolval(request('taskActive'));
    }

    public function newTask()
    {
        $task = new Tasks;
        $task->tasks_group_id = intval(request('task_group'));
        $task->title = 'Новый тест';
        $task->type = '';
        $task->description = 'Описание задания';
        $task->tests = '{
    "maxtime": 1,
    "memory_size": 256,
    "tests": [
        {
            "stdin": "0",
            "stdout": "0"
        }
    ]
}';
        $task->save();
        return redirect()->back();
    }

    public function newTasksGroup()
    {
        $tasksGroup = new TasksGroup;
        $tasksGroup->title = 'Новая группа';
        $tasksGroup->img = asset('assets/img/Contest.png');
        $tasksGroup->save();
        return redirect()->back();
    }

    public function deleteTask($id)
    {
        $task = Tasks::find($id);
        if ($task){
            $task->delete();
            $result = ['response' => 'ok'];
            return response($result, 200)
                ->header('Content-Type', 'text/json');
        }

        $result = ['response' => 'Task not found'];
        return response($result, 500)
            ->header('Content-Type', 'text/json');
    }

    public function deleteTasksGroup($id)
    {
        $tasksGroup = TasksGroup::find($id);
        if ($tasksGroup){
            $tasksGroup->delete();
            $result = ['response' => 'ok'];
            return response($result, 200)
                ->header('Content-Type', 'text/json');
        }

        $result = ['response' => 'Task not found'];
        return response($result, 500)
            ->header('Content-Type', 'text/json');
    }

    public function taskPdf($id)
    {
        $task = Tasks::find($id);
        $tests = json_decode($task->tests);

        $html = view('pdf.task-pdf', [
            'task' => $task,
            'maxtime' => $tests->maxtime,
            'memory_size' => $tests->memory_size,
        ])->render();

        //dd(public_path() . '/assets/fonts/SanFrancisco');
        $fontDirectory = public_path() . '/assets/fonts/SanFrancisco'; //change to the diretory where you fonts is located on your server
        $options = new Options();
        $options->setChroot($fontDirectory);

        $pdfCoder = new Dompdf([
            'enable_remote' => true,
        ]);

        $pdfCoder->loadHtml($html);
        $pdfCoder->setCss(new Stylesheet($pdfCoder));
        $pdfCoder->render();
        $pdfCoder->stream('', [
            'compress' => true,
            'Attachment' => false,
        ]);
    }
}
