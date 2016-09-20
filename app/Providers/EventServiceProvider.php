<?php

namespace App\Providers;

use Illuminate\Contracts\Events\Dispatcher as DispatcherContract;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        'Codemash\Socket\Events\ClientConnected' => [
            'App\Listeners\ClientConnectedListener'
        ],
    	'Codemash\Socket\Events\MessageReceived' => [
    		'App\Listeners\MessageReceivedListener'
    	],
    	'Codemash\Socket\Events\ClientDisconnected' => [
    		'App\Listeners\ClientDisconnectedListener'
    	]
    ];

    /**
     * Register any other events for your application.
     *
     * @param  \Illuminate\Contracts\Events\Dispatcher  $events
     * @return void
     */
    public function boot(DispatcherContract $events)
    {
        parent::boot($events);

        //
    }
}
