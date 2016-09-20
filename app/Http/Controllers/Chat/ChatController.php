<?php

namespace App\Http\Controllers\Chat;

use Illuminate\Http\Request;
use App\User;
use App\Http\Controllers\Controller;

class ChatController extends Controller
{
	public function index()
	{
		return view('chats.index');
	}
}