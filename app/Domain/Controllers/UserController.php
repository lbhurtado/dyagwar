<?php

namespace Dyagwar\Domain\Controllers;

use BotMan\BotMan\BotMan;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Dyagwar\Http\Controllers\Controller;
use Dyagwar\Domain\Conversations\{ ShareConversation, WatchConversation };

class UserController extends Controller
{
	public function __construct()
	{
        Collection::macro('numberize', function () {
            return $this->map(function ($item, $key) { 
                return $key+1 . ') ' . $item;
            })->implode("\n");
        });
	}

    public function join(BotMan $bot)
    {
		$bot->reply(trans('onboarding.welcome'));
    }

    public function share(BotMan $bot)
    {
    	$bot->startConversation(new ShareConversation());
    }

    public function subscribe(BotMan $bot)
    {
		$subscribeItems = collect([
	        'news',
	        'blog',
	        'bulletin',
		]);

		$keywords = $subscribeItems->map(function ($item, $key) { 
			$index = (int) $key + 1;

			return $index .') '.$item;
		})->implode("\n");

	    $bot->ask($keywords, function ($answer, $conversation) use ($subscribeItems) {
	    	$index = $answer->getText() - 1;
	    	$item = $subscribeItems[$index];
	    	$conversation->say(trans('subscription.welcome', compact('item')));
	    });
    }

    public function survey(BotMan $bot)
    {
		$surveyItems = collect([
		        'issues',
		        'sponsored',
		        'popular',
		]);

		$keywords = $surveyItems->map(function ($item, $key) { 
			$index = (int) $key + 1;

			return $index .') '.$item;
		})->implode("\n");

	    $bot->ask($keywords, function ($answer, $conversation) use ($surveyItems) {
	    	$index = $answer->getText() - 1;
	    	$item = $surveyItems[$index];
	    	$conversation->say(trans('survey.welcome', compact('item')));
	    });
    }

    public function update(BotMan $bot)
    {
		$updateItems = collect([
		        'address',
		        'precinct',
		        'resource',
		        'talent'
		]);

		$keywords = $updateItems->map(function ($item, $key) { 
			$index = (int) $key + 1;

			return $index .') '.$item;
		})->implode("\n");

	    $bot->ask($keywords, function ($answer, $conversation) use ($updateItems) {
	    	$index = $answer->getText() - 1;
	    	$item = $updateItems[$index];
	    	$conversation->say(trans('update.gratitude', compact('item')));
	    });
    }

    public function volunteer(BotMan $bot)
    {
		$bot->reply(trans('watcher.welcome'));
    }

    public function watch(BotMan $bot)
    {
    	$bot->startConversation(new WatchConversation());
    }

    public function send(BotMan $bot)
    {
	    $bot->ask('What is your message?', function ($answer, $conversation) {
	    	$message = $answer->getText();
	    	$conversation->ask('To whom?', function ($answer, $conversation) use ($message) {
	  			$username = $answer->getText();
	  			$conversation->say('sending "' . $message . '" to ' . $username);
	    	});
	    });
    }

	public function broadcast(BotMan $bot)
	{
	    $bot->ask('What is your message?', function ($answer, $conversation) {
	    	$message = $answer->getText();
	    	$conversation->ask('To which group?', function ($answer, $conversation) use ($message) {
	  			$groupname = $answer->getText();
	  			$conversation->say('sending "' . $message . '" to ' . $groupname);
	    	});
	    });
	}

	public function strength(BotMan $bot)
	{
	    $bot->reply('TBD: statistics of campaign');
	}

	public function votes(BotMan $bot)
	{
    	$bot->reply('TBD: votes of precinct, clustered precinct, voting center, barangay, municipality');
	}
}
