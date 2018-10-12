<?php

use Dyagwar\Http\Controllers\BotManController;
use Dyagwar\Domain\Controllers\{CommonController, UserController};

$botman = resolve('botman');

$botman->hears('test', function ($bot) {
    $bot->reply('It works!');
});

$botman->hears('Start conversation', BotManController::class.'@startConversation');

$botman->hears('help|/help|\!', CommonController::class.'@help')->skipsConversation();

$botman->hears('stop|/stop|\s', CommonController::class.'@stop')->stopsConversation();

$botman->hears('info|/info|\?', CommonController::class.'@info');

$botman->hears('join|/join', UserController::class.'@join');

$botman->hears('share|/share', UserController::class.'@share');

$botman->hears('subscribe|/subscribe', UserController::class.'@subscribe'); 

$botman->hears('survey|/survey', UserController::class.'@survey'); 

$botman->hears('update|/update', UserController::class.'@update'); 

$botman->hears('volunteer|/volunteer', function ($bot) {
    $bot->reply('TBD: thank you for becoming a poll watcher.');
});

// $watcherTasks = collect([
//         'task1.preparation',
//         'task2.precinct',
//         'task3.pcos',
//         'task4.casting',
//         'task5.printing',
//         'task6.pollcount',
// ]);

$botman->hears('watcher|/watcher', UserController::class.'@watcher');
// {
	// $keywords = $watcherTasks->map(function ($item, $key) { 
	// 	$index = (int) $key + 1;

	// 	return $index .') '.$item;
	// })->implode("\n");

 //    $bot->ask($keywords, function ($answer, $conversation) use ($watcherTasks) {
 //    	$index = $answer->getText() - 1;
 //    	$conversation->say('TBD: Poll Watcher Task ' . $watcherTasks[$index]);
 //    });
// });

$botman->hears('send|/send', function ($bot) {
    $bot->ask('What is your message?', function ($answer, $conversation) {
    	$message = $answer->getText();
    	$conversation->ask('To whom?', function ($answer, $conversation) use ($message) {
  			$username = $answer->getText();
  			$conversation->say('sending "' . $message . '" to ' . $username);
    	});
    });
});

$botman->hears('broadcast|/broadcast', function ($bot) {
    $bot->ask('What is your message?', function ($answer, $conversation) {
    	$message = $answer->getText();
    	$conversation->ask('To which group?', function ($answer, $conversation) use ($message) {
  			$groupname = $answer->getText();
  			$conversation->say('sending "' . $message . '" to ' . $groupname);
    	});
    });
});

$botman->hears('str|/str|stregth|/str', function ($bot) {
    $bot->reply('TBD: statistics of campaign');
});

$botman->hears('votes|/votes', function ($bot) {
    $bot->reply('TBD: votes of precinct, clustered precinct, voting center, barangay, municipality');
});
