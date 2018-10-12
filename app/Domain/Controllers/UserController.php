<?php

namespace Dyagwar\Domain\Controllers;

use BotMan\BotMan\BotMan;
use Illuminate\Http\Request;
use Dyagwar\Http\Controllers\Controller;
use Dyagwar\Domain\Conversations\ShareConversation;

class UserController extends Controller
{


    public function join(BotMan $bot)
    {
		$bot->reply('Onboarding...');
    }

    public function share(BotMan $bot)
    {
    	$bot->startConversation(new ShareConversation());
    }
}
