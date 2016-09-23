var socket;
var channelId = 0;
var loadedMessageCount = 0;

jQuery(document).ready(function()
{
	socket = window.appSocket;
	$.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    socket.on('textMessage', function (newMessage) {
    	console.log(newMessage);
        receiveTextMessage(newMessage);
    });

    socket.connect(function () {
        
    });
    
    $('#chat-panel').click(function()
    {
    	readMessages(channelId);
    });
});

function receiveTextMessage(messageJson)
{
	var message = JSON.parse(messageJson);
	if(message.channel_id == channelId)
	{
		displayTextMessage(message);
	}
	else
	{
		var unread = parseInt($('#unread-'+message.channel_id).text());
		if(isNaN(unread))
		{
			$('#unread-'+message.channel_id).text('1');
		}
		else
		{
			$('#unread-'+message.channel_id).text(unread+1);
		}
	}
}

function channelSelected(id)
{
	channelId = id;
	loadedMessageCount = 0;
	jQuery('#chat-body').empty();
	jQuery.ajax(
	{
		url: '/channel/chat-top/'+id,
		type: 'GET',
		success: function(response)
		{
			reinitializeChannel();
			$('#chat-heading').append(response);
		}
	});
	
	loadMessages();
	
	readMessages(id);
}

function sendTextMessage()
{
	var message = jQuery('#message-text').val();
	if((message != '') && (channelId != 0))
	{
		socket.send('textMessage', createTextMessageObject(message));
		jQuery('#message-text').val('');
	}
}

function readMessages(channelId)
{
	jQuery.ajax(
	{
		url: '/channel/markread/'+channelId,
		type: 'GET',
		success: function(response)
		{
			$('#unread-'+channelId).text('');
		}
	})
}

function loadMessages()
{
	jQuery.ajax(
		{
			url: '/channel/messages/'+channelId+'/'+loadedMessageCount,
			type: 'GET',
			success: function(response)
			{
				loadedMessageCount++;
				var messages = response.messages;
				var more = response.more;
				for(var i in messages)
				{
					message = messages[i];
					displayTextMessage(message);
				}
				if(more == true)
				{
					jQuery('#chat-body').prepend('<a id="load-more-link" href="#" onclick="loadOldMessages()">Load More</a><br/>');
				}
				else
				{
					jQuery('#load-more-link').remove();
				}
			}
		}
	);
}

function loadOldMessages()
{
	jQuery.ajax(
		{
			url: '/channel/messages/'+channelId+'/'+loadedMessageCount,
			type: 'GET',
			success: function(response)
			{
				loadedMessageCount++;
				var messages = response.messages;
				var more = response.more;
				for(var i in messages)
				{
					message = messages[i];
					displayOldTextMessage(message);
				}
				if(more == true)
				{
					jQuery('#chat-body').prepend('<a id="load-more-link" href="#" onclick="loadOldMessages()">Load More</a><br/>');
				}
				else
				{
					jQuery('#load-more-link').remove();
				}
			}
		}
	);
}

function createTextMessageObject(message)
{
	var messageObject = {
		'channel_id': channelId,
		'text': message
	};
	return JSON.stringify(messageObject);
}

function reinitializeChannel()
{
	jQuery('#chat-heading').empty();
	jQuery('#chat-body').empty();
}

function displayOldTextMessage(message)
{
	jQuery('#chat-body').prepend('<span class="sender-name">' + message.user.name + '</span> : ' + message.text + '<br/>');
}

function displayTextMessage(message)
{
	jQuery('#chat-body').append('<span class="sender-name">' + message.user.name + '</span> : ' + message.text + '<br/>');
}