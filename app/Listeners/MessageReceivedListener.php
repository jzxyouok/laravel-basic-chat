<?php

namespace App\Listeners;

use Codemash\Socket\Events\MessageReceived;
use App\Repositories\Chat\MessageRepository;
use App\Repositories\Chat\ChannelRepository;

class MessageReceivedListener
{
	protected $messageRepository;
	protected $channelRepository;
	/**
	 * Create the event listener.
	 *
	 * @return void
	 */
	public function __construct(MessageRepository $messageRepository, ChannelRepository $channelRepository)
	{
		$this->messageRepository = $messageRepository;
		$this->channelRepository = $channelRepository;
	}

	/**
	 * Handle the event.
	 *
	 * @param  MessageReceived  $event
	 * @return void
	 */
	public function handle(MessageReceived $event)
	{
		$user = $event->client->getUser();
		$message = $event->message;
		$command = $message->command;
		$message = json_decode($message->data);
		if($command === 'textMessage')
		{
			$returnValue = $this->messageRepository->saveTextMessage($message, $user);
			$message = $returnValue['message'];
			$channel = $returnValue['channel'];
			$users = $channel->users;
			foreach ($users as $currentUser)
			{
				if(($user->is_online == 0) || empty($user->is_online))
				{
					$client = $event->clients->where('id', $user->connection_id)->first();
					$client->send('textMessage', $message->only(['text', 'channel_id', 'created_at']));
				}
			}
		}
		else if($command == 'fileMessage')
		{
		
		}
	}
}