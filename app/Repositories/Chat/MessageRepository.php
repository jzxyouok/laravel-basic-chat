<?php

namespace App\Repositories\Chat;

use App\Models\Channel;
use App\Models\Message;

class MessageRepository
{	
	public function saveTextMessage($messageObject, $user)
	{
		$channelID = $messageObject->channel_id;
		$channel = Channel::find($channelID);
		$message = new Message();
		$message->type = 'text';
		$message->text = $messageObject->text;
		$message->channel_id = $channel->id;
		$message->user_id = $user->id;
		$message->save();
		return [
				'message' => $message,
				'channel' => $channel
		];
	}
}