@extends('layouts.app')

@section('content')
	<div class="container">
	<div class="row">
		<div class="col-md-2">
			<div class="row">
				<div class="col-md-12">
					One
				</div>
				<div class="col-md-12">
					Two
				</div>
				<div class="col-md-12">
					Three
				</div>
			</div>
		</div>
		<div class="col-md-10">
			<div class="panel panel-default" id="chat-panel">
  				<div class="panel-heading" id="chat-heading">Panel Heading</div>
  				<div class="panel-body" id="chat-body">Panel Content</div>
  				<div class="panel-footer" id="chat-footer">Panel Footer</div>
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