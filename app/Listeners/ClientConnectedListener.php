<?php

namespace App\Listeners;

use Codemash\Socket\Events\ClientConnected;

class ClientConnectedListener
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
	public function handle(ClientConnected $event)
	{
		echo $event->client->getUser()->email;
	}
}