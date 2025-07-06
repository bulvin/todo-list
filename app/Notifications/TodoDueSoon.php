<?php

namespace App\Notifications;

use App\Models\Todo;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class TodoDueSoon extends Notification implements ShouldQueue
{
    use Queueable;

    /**
     * Create a new notification instance.
     */
    public function __construct(public Todo $todo)
    {

    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage)
            ->subject('Reminder: Your To-Do is Due Tomorrow!')
            ->line("Task: {$this->todo->name}")
            ->line("Due Date: {$this->todo->due_date->format('l, d F Y')}")
            ->action('View Task', url('/todos/' . $this->todo->id))
            ->line('Please make sure to complete it on time!');
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            //
        ];
    }
}
