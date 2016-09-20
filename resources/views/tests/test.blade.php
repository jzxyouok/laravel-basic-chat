@extends('layouts.app')

@section('content')
	<button onclick="sendMessage()">Send message</button>
@endsection

@section('custom-scripts')
	{!! Socket::javascript() !!}
	<script>window.appSocket = new Socket("ws://localhost:8043");</script>
	<script type="text/javascript" src="{{ asset('js/chat-custom.js') }}"></script>
@endsection