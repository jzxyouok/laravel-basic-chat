@extends('layouts.app')

@section('content')
	<div class="container">
	<div class="row">
		<div class="col-md-2">
			<div class="row" id="contacts-sidebar">
				@foreach(Auth::user()->channels as $channel)
				<a class="col-md-12 chat-grid" onclick="channelSelected({{ $channel->id }})">
					{{ $channel->otherUser()->name }}
					<span id="unread-{{ $channel->id }}">{{ $channel->unreadMessagesCount() }}</span>
				</a>
				@endforeach
			</div>
		</div>
		<div class="col-md-10">
			<div class="panel panel-default" id="chat-panel">
  				<div class="panel-heading" id="chat-heading"></div>
  				<div class="panel-body" id="chat-body"></div>
  				<div class="panel-footer" id="chat-footer">
  					<div class="row">
  						<div class="col-md-1">
							<label class="btn btn-primary">
    							File
    							<input type="file" id="chat-file-input" style="display: none;">
							</label>
						</div>
  						<div class="col-md-10">
  							<input type="text" class="form-control" id="message-text" placeholder="Write message here..."/>
  						</div>
  						<div class="col-md-1">
  							<button class="btn btn-default" onclick="sendTextMessage()">Send</button>
  						</div>
  					</div>
				</div>
			</div>
		</div>
	</div>
	</div>
@endsection

@section('custom-scripts')
	{!! Socket::javascript() !!}
	<script>window.appSocket = new Socket("ws://localhost:8043");</script>
	<script type="text/javascript" src="{{ asset('js/chat-custom.js') }}"></script>
@endsection