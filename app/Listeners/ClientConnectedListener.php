<?php

namespace App\Listeners;

use Codemash\Socket\Events\ClientConnected;
use Carbon\Carbon;

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
		$user = $event->client->getUser();
		$user->is_online = 1;
		$user->last_seen_at = Carbon::now();
		$user->connection_id = $event->client->id;
		$user->save();
	}
}