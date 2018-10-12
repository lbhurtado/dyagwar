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

// $shareItems = collect([
//         'picture',
//         'video',
//         'audio',
//         'location',
//         'file',
//         'intel',
// ]);

$botman->hears('share|/share', UserController::class.'@share');

// $botman->hears('share|/share', function ($bot) use ($shareItems) {
// 	$keywords = $shareItems->map(function ($item, $key) { 
// 		$index = (int) $key + 1;

// 		return $index .') '.$item;
// 	})->implode("\n");

//     $bot->ask($keywords, function ($answer, $conversation) use ($shareItems) {
//     	$index = $answer->getText() - 1;
//     	$conversation->say('Nice of you to share ' . $shareItems[$index]);
//     });
// });

$subscribeItems = collect([
        'news',
        'blog',
        'bulletin',
]);

$botman->hears('subscribe|/subscribe', function ($bot) use ($subscribeItems) {
	$keywords = $subscribeItems->map(function ($item, $key) { 
		$index = (int) $key + 1;

		return $index .') '.$item;
	})->implode("\n");

    $bot->ask($keywords, function ($answer, $conversation) use ($subscribeItems) {
    	$index = $answer->getText() - 1;
    	$conversation->say('TBD: Nice of you to subscribe to ' . $subscribeItems[$index] . '.');
    });
});

$surveyItems = collect([
        'issues',
        'sponsored',
        'popularity',
]);

$botman->hears('survey|/survey', function ($bot) use ($surveyItems) {
	$keywords = $surveyItems->map(function ($item, $key) { 
		$index = (int) $key + 1;

		return $index .') '.$item;
	})->implode("\n");

    $bot->ask($keywords, function ($answer, $conversation) use ($surveyItems) {
    	$index = $answer->getText() - 1;
    	$conversation->say('TBD: Nice of you to participate in ' . $surveyItems[$index] . ' survey.');
    });
});

$updateItems = collect([
        'address',
        'precinct',
        'resource',
        'talent'
]);

$botman->hears('update|/update', function ($bot) use ($updateItems) {
	$keywords = $updateItems->map(function ($item, $key) { 
		$index = (int) $key + 1;

		return $index .') '.$item;
	})->implode("\n");

    $bot->ask($keywords, function ($answer, $conversation) use ($updateItems) {
    	$index = $answer->getText() - 1;
    	$conversation->say('TBD: Nice of you to update your ' . $updateItems[$index] . ' data.');
    });
});

$botman->hears('volunteer|/volunteer', function ($bot) {
    $bot->reply('TBD: thank you for becoming a poll watcher.');
});

$watcherTasks = collect([
        'task1.preparation',
        'task2.precinct',
        'task3.pcos',
        'task4.casting',
        'task5.printing',
        'task6.pollcount',
]);

$botman->hears('watch|/watch', function ($bot) use ($watcherTasks) {
	$keywords = $watcherTasks->map(function ($item, $key) { 
		$index = (int) $key + 1;

		return $index .') '.$item;
	})->implode("\n");

    $bot->ask($keywords, function ($answer, $conversation) use ($watcherTasks) {
    	$index = $answer->getText() - 1;
    	$conversation->say('TBD: Poll Watcher Task ' . $watcherTasks[$index]);
    });
});

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
