<?php

namespace App\Providers;

use Illuminate\Support\Facades\Event;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        'App\Events\Video\VideoUpdated' => [
            'App\Listeners\Video\AutoTag',
            // 'App\Listeners\Video\FetchSubtitles',

        ],
        'App\Events\Star\StarsUpdated' => [
            'App\Listeners\Star\SendNotifications',
        ],
        'App\Events\Video\MetaDataUpdated' => [
            'App\Listeners\Video\NotifyCheck',
        ]
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        parent::boot();

        //
    }
}
