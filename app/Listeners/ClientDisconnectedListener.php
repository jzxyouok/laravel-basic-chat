<?php

namespace App\Listeners;

use Codemash\Socket\Events\ClientDisconnected;
use Carbon\Carbon;
use Log;

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
		$user = $event->client->getUser();
		$user->is_online = 0;
		$user->last_seen_at = Carbon::now();
		$user->connection_id = null;
		$user->save();
		
		$channels = $user->channels;
		foreach ($channels as $channel)
		{
			$otherUser = $channel->otherThanGivenUser($user);
			if(($otherUser->is_online == 1) && !empty($otherUser->connection_id))
			{
				$object = [
						'channel_id' => $channel->id,
						'online' => $user->is_online
				];
				$client = $event->clients->where('id', $otherUser->connection_id)->first();
				if(!empty($client))
				{
					$client->send('onlineStatus', json_encode($object));
				}
			}
		}
	}
}