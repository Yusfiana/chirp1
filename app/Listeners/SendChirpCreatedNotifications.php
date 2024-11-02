<?php

namespace App\Listeners;

use App\Events\ChirpCreated;
use App\Models\User;
use App\Notifications\NewChirp;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;    

class SendChirpCreatedNotifications implements ShouldQueue
{
    /**
     * Handle the event.
     */
    public function handle(ChirpCreated $event): void
    {
        // Fetch users excluding the one who created the Chirp
        foreach (User ::where('id', '!=', $event->chirp->user_id)->cursor() as $user) {
            try {
                $user->notify(new NewChirp($event->chirp));
                \Log::info('Notification sent to user: ' . $user->email);
            } catch (\Exception $e) {
                \Log::error('Failed to send notification to user: ' . $user->email . ' - Error: ' . $e->getMessage());
            }
        }
    }
}
