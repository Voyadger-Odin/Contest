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
        $previous_solutions = PreviousSolutions::create([
            'user_id' => intval(request('user_id')),
            'task_id' => intval(request('task_id')),
            'code' => request('code'),
            'lang' => request('lang'),
            'status' => intval(request('status'))
        ]);

        return response($previous_solutions, 200)
            ->header('Content-Type', 'text/json');
    }

    public function setSolutionResult()
    {
        $result = DB::table('previous_solutions')
            ->where('id', intval(request('solution_id')))
            ->update([
                'result' => request('result'),
                'status' => request('solution_status'),
            ]);
        return 'ok';
    }

    public function getSolutionResult($id)
    {
        $previousSolutions = PreviousSolutions::find($id);

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
        $urlServerTest =  env('SERVER_TESTS_URL', 'SERVER_TESTS_URL') . '/send-solution';
        $url_save_solution = route('save_solution');
        $url_set_solution_result = route('set_solution_result');

        $task_id = intval(request('task_id'));
        $tests = json_decode(Tasks::find($task_id)->tests);
        $data = [
            'language' => request('language'),
            'code' => request('code'),
            'user_id' => intval(request('user_id')),
            'task_id' => $task_id,
            'tests' => $tests,
            'url_save_solution' => $url_save_solution,
            'url_set_solution_result' => $url_set_solution_result,
        ];
        $res = Http::post($urlServerTest, $data);
        return response($res, 200)
            ->header('Content-Type', 'text/json');
    }
}
