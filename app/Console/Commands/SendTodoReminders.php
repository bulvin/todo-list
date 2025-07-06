<?php

namespace App\Console\Commands;

use App\Enums\TodoStatus;
use App\Models\Todo;
use App\Notifications\TodoDueSoon;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Symfony\Component\Console\Command\Command as CommandAlias;

class SendTodoReminders extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'todos:send-todo-reminders';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send email reminders for todos due tomorrow';

    /**
     * Execute the console command.
     */
    public function handle() : int
    {


        $tomorrow = Carbon::tomorrow()->startOfDay();

        $todos =  Todo::whereDate('due_date', $tomorrow)->get();

        foreach ($todos as $todo) {
            if ($todo->user && $todo->user->email) {
                $todo->user->notify(new TodoDueSoon($todo));
            }
        }

        $this->info('Reminders dispatched: ' . $todos->count());

        return CommandAlias::SUCCESS;
    }
}
