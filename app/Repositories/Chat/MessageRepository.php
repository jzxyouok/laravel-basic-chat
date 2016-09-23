<?php

namespace App\Repositories\Chat;

use App\Models\Channel;
use App\Models\Message;
use App\User;

class MessageRepository
{	
	public function saveTextMessage($message, $user)
	{
		$messageObject = json_decode($message);
		$channelID = $messageObject->channel_id;
		$channel = Channel::find($channelID);
		$message = new Message();
		$message->type = 'text';
		$message->text = $messageObject->text;
		$message->channel_id = $channel->id;
		$message->user_id = $user->id;
		$message->save();
		
		$user = User::find($message->user_id);
		$message->user = $user;
		
		return [
				'message' => $message,
				'channel' => $channel
		];
	}
}