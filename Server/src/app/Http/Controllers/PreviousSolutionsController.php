<?php

namespace App\Http\Controllers;

use App\Models\PreviousSolutions;
use App\Models\Tasks;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;

class PreviousSolutionsController extends Controller
{
    public function saveSolution()
    {
        $previous_solutions = saveSolution(
            intval(request('user_id')),
            intval(request('task_id')),
            request('code'),
            request('lang'),
            intval(request('status'))
        );

        return response($previous_solutions, 200)
            ->header('Content-Type', 'text/json');
    }

    public function setSolutionResult()
    {
        $updateResult = setSolutionResult(
            intval(request('solution_id')),
            request('result'),
            request('solution_status')
        );

        if (!$updateResult){
            $result = ['response' => 'Solution not found'];
            return response($result, 500)
                ->header('Content-Type', 'text/json');
        }

        $result = ['response' => 'ok'];
        return response($result, 200)
            ->header('Content-Type', 'text/json');
    }

    public function getSolutionResult($solution_id)
    {
        $previousSolutions = getSolution($solution_id);

        // Если пользователь пытается посмотреть не своё задание
        if ($previousSolutions->user_id != Auth::user()->id){
            $result = ['response' => 'You do not have sufficient rights to view this task'];
            return response($result, 401)
                ->header('Content-Type', 'text/json');
        }

        $result = [
            'id' => $previousSolutions->id,
            'language' => $previousSolutions->lang,
            'status' => $previousSolutions->status,
            'code' => $previousSolutions->code,
            'result' => json_decode($previousSolutions->result),
        ];

        return response($result, 200)
            ->header('Content-Type', 'text/json');
    }

    // Отправка решения пользователя на проверку
    public function sendSolution()
    {
        $res = sendSolution(
            request('language'),
            request('code'),
            intval(request('user_id')),
            intval(request('task_id'))
        );

        return response($res, 200)
            ->header('Content-Type', 'text/json');
    }
}
