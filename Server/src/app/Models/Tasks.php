<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Tasks extends Model
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
        'description',
        'tests',
    ];
    public function taskGroup(): BelongsTo
    {
        return $this->belongsTo(
            TasksGroup::class,
            'tasks_group_id',
            'id',
            'tasks_groups'
        );
    }

    public function getDiscription()
    {
        $result = '';
        foreach (preg_split('/\r\n|\r|\n/', $this->description) as $line){
            $line = str_replace('\\', '\\\\', $line);
            $line = str_replace('\'', '\\\'', $line);
            $result .= '' . $line . '\\n';
        }
        return $result;
    }

    public function checkCompleted($user_id)
    {
        $data = $this->belongsTo(
            PreviousSolutions::class,
            'id',
            'task_id',
            'previous_solutions'
        )
            ->where([
                ['status', '=', '0'],
                ['user_id', '=', $user_id]
            ])
            ->first();
        return boolval($data);
    }

    public function getLastSolution($user_id)
    {
        $solution = PreviousSolutions::select()
            ->where([
                ['user_id', '=', $user_id],
                ['task_id', '=', $this->id],
            ])
            ->orderBy('id', 'DESC')
            ->first();
        return $solution;
    }
}
