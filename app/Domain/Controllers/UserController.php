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
	    	$conversation->say('TBD: Nice of you to subscribe to ' . $subscribeItems[$index] . '.');
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
	    	$conversation->say('TBD: Nice of you to participate in ' . $surveyItems[$index] . ' survey.');
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
	    	$conversation->say('TBD: Nice of you to update your ' . $updateItems[$index] . ' data.');
	    });
    }

    public function watcher(BotMan $bot)
    {
		$watcherTasks = collect([
		        'task1.preparation',
		        'task2.precinct',
		        'task3.pcos',
		        'task4.casting',
		        'task5.printing',
		        'task6.pollcount',
		]);

		$keywords = $watcherTasks->map(function ($item, $key) { 
			$index = (int) $key + 1;

			return $index .') '.$item;
		})->implode("\n");

	    $bot->ask($keywords, function ($answer, $conversation) use ($watcherTasks) {
	    	$index = $answer->getText() - 1;
	    	$conversation->say('TBD: Poll Watcher Task ' . $watcherTasks[$index]);
	    });
    }
}
