<?php

namespace App\Notifications;

use App\Models\Chirp;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class NewChirp extends Notification implements ShouldQueue
{
    use Queueable;

    public function __construct(public Chirp $chirp)
    {
    }

    public function via($notifiable)
    {
        return ['mail'];
    }

    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->subject("New Chirp from {$this->chirp->user->name}")
            ->line("{$this->chirp->user->name} has posted a new Chirp!")
            ->line($this->chirp->message)
            ->action('Go to Chirps', url('127.0.0.1:8000/chirps'))
            ->line('Thank you for using our application!');
    }
}