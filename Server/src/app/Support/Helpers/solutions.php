<?php

use App\Models\PreviousSolutions;
use Illuminate\Http\Client\Response;
use Illuminate\Support\Facades\Http;

function getSolution($solution_id): PreviousSolutions
{
    return PreviousSolutions::find($solution_id);
}

// Создать новое решение
function saveSolution($user_id, $task_id, $code, $lang, $status): PreviousSolutions
{
    $previous_solutions = PreviousSolutions::create([
        'user_id' => $user_id,
        'task_id' => $task_id,
        'code' => $code,
        'lang' => $lang,
        'status' => $status
    ]);
    return $previous_solutions;
}

// Сохранить результат решения
function setSolutionResult($solution_id, $result, $status): bool
{
    $solution = getSolution($solution_id);
    if (!$solution){return false;}

    $updateResult = $solution->update([
        'result' => $result,
        'status' => $status,
    ]);

    return $updateResult;
}

function sendSolution($language, $code, $user_id, $task_id): Response
{
    $urlServerTest =  env('SERVER_TESTS_URL', 'SERVER_TESTS_URL') . '/send-solution';
    $url_save_solution = route('save_solution');
    $url_set_solution_result = route('set_solution_result');

    $task = getTask($task_id);
    $tests = getTaskTests($task);
    $data = [
        'language' => $language,
        'code' => $code,
        'user_id' => $user_id,
        'task_id' => $task_id,
        'tests' => $tests,
        'url_save_solution' => $url_save_solution,
        'url_set_solution_result' => $url_set_solution_result,
    ];
    return Http::post($urlServerTest, $data);
}
