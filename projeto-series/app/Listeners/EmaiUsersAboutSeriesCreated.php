<?php

namespace App\Listeners;

use App\Mail\SeriesCreated;
use App\Models\User;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Mail;

class EmaiUsersAboutSeriesCreated
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  object  $event
     * @return void
     */
    public function handle(SeriesCreated $event)
    {
        $emails = User::pluck('email');

        foreach ($emails as $index => $email) {
            $emailMessage = new SeriesCreated(
                $event->seriesNome,
                $event->seriesId,
                $event->seriesSeasonsQty,
                $event->seriesEpisodesPerSeason
            );

            $when = now()->addSeconds($index * 5);

            Mail::to($email)->later($when, $emailMessage);
        }
    }
}
