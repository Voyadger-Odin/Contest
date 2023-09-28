<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Query\JoinClause;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class TasksGroup extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'active',
        'title',
        'img',
    ];

    public function tasks(): BelongsTo
    {

        $tasks = $this->belongsTo(
            Tasks::class,
            'id',
            'tasks_group_id',
            'tasks'
        );
        if (Auth::user()->role != 'admin'){
            $tasks = $tasks->where('active', '=', true);
        }
        return $tasks;
    }

    public function getCompletedTasks($user_id)
    {
        $data = DB::table('tasks')
            ->select('tasks.id as task_id')
            ->where([
                ['tasks.tasks_group_id', $this->id],
                ['previous_solutions.status', '0'],
                ['previous_solutions.user_id', $user_id],
            ])
            ->crossJoin('previous_solutions', 'tasks.id', '=', 'previous_solutions.task_id')
            ->groupBy('tasks.id')
            ->get();

        return $data;
    }
}
