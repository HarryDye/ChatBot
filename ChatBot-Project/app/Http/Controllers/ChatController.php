<?php

namespace App\Http\Controllers;
use App\Events\ChatStarted;
use App\Chat;


use Illuminate\Http\Request;

class ChatController extends Controller
{
    public function index()
    {
      $messages = Chat::all();

      return view('welcome', compact('messages'));
    }

    public function create()
    {
      return Chat::all();
    }

    public function store()
    {
      $messages = Chat::all();

      $text = new Chat();

      $text->content = request('text');

      broadcast(new ChatStarted($text))->toOthers();

      $text->save();

      //function that stops the redirect and

      // return view('welcome', compact('messages'));
      return ['status' => 'OK'];
    }
}
