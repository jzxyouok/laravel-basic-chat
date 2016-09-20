<?php

namespace App\Listeners;

use Codemash\Socket\Events\ClientDisconnected;

class ClientDisconnectedListener
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
	 * @param  ClientConnected $event
	 * @return void
	 */
	public function handle(ClientDisconnected $event)
	{
		echo $event->client->getUser()->email;
	}
}