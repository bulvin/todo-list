<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Models\Todo;
use App\Models\User;
use App\Notifications\TodoDueSoon;
use Carbon\Carbon;
use Illuminate\Support\Facades\Notification;
use Tests\TestCase;


class SendTodoRemindersTest extends TestCase
{
    use RefreshDatabase;

    public function testShouldSendRemindersWhenTodosAreDueTomorrow()
    {
        Notification::fake();

        $dueDate = Carbon::tomorrow()->startOfDay();

        $user = User::factory()->create();
        $todoDueTomorrow = Todo::factory()->create([
            'user_id' => $user->id,
            'due_date' => $dueDate,
        ]);

        $this->artisan('todos:send-todo-reminders')
            ->expectsOutput('Reminders dispatched: 1')
            ->assertExitCode(0);

        Notification::assertSentTo(
            [$user],
            TodoDueSoon::class,
            function ($notification, $channels) use ($todoDueTomorrow) {
                return $notification->todo->id === $todoDueTomorrow->id && in_array('mail', $channels);
            }
        );
    }

    public function testShouldNotSendRemindersWhenNoTodosAreDueTomorrow()
    {
        Notification::fake();

        $this->artisan('todos:send-todo-reminders')
            ->expectsOutput('Reminders dispatched: 0')
            ->assertExitCode(0);

        Notification::assertNothingSent();
    }
}
