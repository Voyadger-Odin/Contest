<?php

use App\Models\Tasks;
use App\Models\TasksGroup;
use Dompdf\Css\Stylesheet;
use Dompdf\Dompdf;
use Dompdf\Options;

// Получить список групп тестов
function getTasksGroupList($all_tasks)
{
    $tasksGroups = null;
    if ($all_tasks){
        $tasksGroups = TasksGroup::all();
    }else{
        $tasksGroups = TasksGroup::select()
            ->where('active', '=', true)
            ->get();
    }

    return $tasksGroups;
}


// Получить задание
function getTask($task_id): Tasks | null
{
    return Tasks::find($task_id);
}

function getTasksGroup($task_group_id): TasksGroup | null
{
    return TasksGroup::find($task_group_id);
}

// Получить список тестов для задания
function getTaskTests($task): mixed
{
    return json_decode($task->tests);
}

// Сохранить / Обновить группу заданий
function saveTasksGroup($task_group_id, $active, $title, $img): bool
{
    $tasksGroup = getTasksGroup($task_group_id);
    if (!$tasksGroup){return false;}

    return $tasksGroup->update([
        'active' => $active,
        'title' => $title,
        'img' => $img,
    ]);
}

// Сохранить / Обновить задание
function saveTask($task_id, $active, $title, $description, $tests): bool
{
    $task = getTask($task_id);
    if (!$task) {
        return false;
    }

    return $task->update([
        'active' => $active,
        'title' => $title,
        'description' => $description,
        'tests' => $tests,
    ]);
}

// Создать новое задание
function newTask(): bool
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
    return $task->save();
}

// Создать новую группу заданий
function newTasksGroup(): bool
{
    $tasksGroup = new TasksGroup;
    $tasksGroup->title = 'Новая группа';
    $tasksGroup->img = asset('assets/img/Contest.png');
    return $tasksGroup->save();
}


// Удалить задание
function deleteTask($task_id): bool
{
    $task = getTask($task_id);
    if (!$task){return false;}

    return $task->delete();
}

// Удалить группу заданий
function deleteTasksGroup($task_group_id): bool
{
    $tasksGroup = getTasksGroup($task_group_id);
    if (!$tasksGroup){return false;}

    return $tasksGroup->delete();
}

function setPdfFonts(
    $fontDirectory,
    $fontFamily,
    $fontNameNormalNormal,
    $fontNameItalicNormal,
    $fontNameNormalBold,
    $fontNameItalicBold,
): void
{
    $options = new Options();
    $options->setChroot($fontDirectory);
    $pdfCoder = new Dompdf($options);

    $pdfCoder->getFontMetrics()->registerFont(
        ['family' => $fontFamily, 'style' => 'normal', 'weight' => 'normal'],
        $fontDirectory . '/' . $fontNameNormalNormal
    );
    $pdfCoder->getFontMetrics()->registerFont(
        ['family' => $fontFamily, 'style' => 'italic', 'weight' => 'normal'],
        $fontDirectory . '/' . $fontNameItalicNormal
    );
    $pdfCoder->getFontMetrics()->registerFont(
        ['family' => $fontFamily, 'style' => 'normal', 'weight' => 'bold'],
        $fontDirectory . '/' . $fontNameNormalBold
    );
    $pdfCoder->getFontMetrics()->registerFont(
        ['family' => $fontFamily, 'style' => 'italic', 'weight' => 'bold'],
        $fontDirectory . '/' . $fontNameItalicBold
    );
}

// Получить PDF-файл заданий
function getTaskPdf($task_id, $attachment=false): void
{
    $task = getTask($task_id);
    $tests = getTaskTests($task);

    $html = view('pdf.task-pdf', [
        'task' => $task,
        'maxtime' => $tests->maxtime,
        'memory_size' => $tests->memory_size,
    ])->render();

    // Добавление шрифтов

    $fontDirectory = public_path() . '/assets/fonts/SanFrancisco'; //change to the diretory where you fonts is located on your server
    setPdfFonts(
        $fontDirectory,
        'SF UI Text',
        'SFUIText-Regular.ttf',
        'SFUIText-Italic.ttf',
        'SFUIText-Bold.ttf',
        'SFUIText-BoldItalic.ttf',
    );

    $pdfCoder = new Dompdf([
        'enable_remote' => true, // Разрешить загружать файлы (картинки)
    ]);

    $pdfCoder->loadHtml($html);
    $pdfCoder->render();
    $pdfCoder->stream('', [
        'compress' => false,
        'Attachment' => $attachment, // Отображать в PDF-viewer браузера
    ]);
}
