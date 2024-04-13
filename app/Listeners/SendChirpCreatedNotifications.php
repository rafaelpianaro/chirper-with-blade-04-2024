<?php

namespace App\Listeners;

use App\Events\ChirpCreated;
use App\Models\User;
use App\Models\Chirp;
use App\Notifications\NewChirp;
use Illuminate\Support\Facades\Log;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Queue\InteractsWithQueue;

class SendChirpCreatedNotifications implements ShouldQueue
{
    /**
     * Handle the event.
     */
    public function handle(ChirpCreated $event): void
    {
        //
        foreach (User::whereNot('id', $event->chirp->user_id)->cursor() as $user) {
            $user->notify(new NewChirp($event->chirp));
        }
    }


    // foi necessário para poder debugar, lembrar sempre de não ter registros deletados 
    // commands para auxiliar
    // php artisan queue:work
    // php artisan queue:work --verbose
    // php artisan queue:failed
    // php artisan queue:retry all


    // public function handle(ChirpCreated $event): void
    // {
    //     Log::info('Starting to handle ChirpCreated event', ['chirp_id' => $event->chirp->id]);
    
    //     try {
    //         $chirp = Chirp::findOrFail($event->chirp->id);
    //         Log::info('Chirp found', ['chirp_id' => $chirp->id]);
    
    //         foreach (User::whereNot('id', $chirp->user_id)->cursor() as $user) {
    //             $user->notify(new NewChirp($chirp));
    //             Log::info('Notified user', ['user_id' => $user->id, 'chirp_id' => $chirp->id]);
    //         }
    //     } catch (ModelNotFoundException $e) {
    //         Log::error('Chirp not found', ['chirp_id' => $event->chirp->id]);
    //         return;
    //     } catch (\Exception $e) {
    //         Log::error('Error handling ChirpCreated event', [
    //             'chirp_id' => $event->chirp->id,
    //             'error' => $e->getMessage(),
    //             'trace' => $e->getTraceAsString()
    //         ]);
    //     }
    // }
    
}


