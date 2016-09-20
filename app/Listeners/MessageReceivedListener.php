<?php

namespace App\Listeners;

use Codemash\Socket\Events\MessageReceived;

class MessageReceivedListener
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
	 * @param  MessageReceived  $event
	 * @return void
	 */
	public function handle(MessageReceived $event)
	{
		$message = $event->message;
        echo $event->client->getUser()->email.' : '.json_encode($message);
	}
}