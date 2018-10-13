<?php

use Dyagwar\Http\Controllers\BotManController;
use Dyagwar\Domain\Controllers\{CommonController, UserController};

$botman = resolve('botman');

$botman->hears('test', function ($bot) {
    $bot->reply('It works!');
});

$botman->hears('icebreaker|ice breaker', BotManController::class.'@startConversation');

$botman->hears('help|/help|\!', CommonController::class.'@help')->skipsConversation();

$botman->hears('stop|/stop|\s', CommonController::class.'@stop')->stopsConversation();

$botman->hears('info|/info|\?', CommonController::class.'@info');

$botman->hears('join|/join', UserController::class.'@join');

$botman->hears('share|/share', UserController::class.'@share');

$botman->hears('subscribe|/subscribe', UserController::class.'@subscribe'); 

$botman->hears('survey|/survey', UserController::class.'@survey'); 

$botman->hears('update|/update', UserController::class.'@update'); 

$botman->hears('volunteer|/volunteer', UserController::class.'@volunteer'); 

$botman->hears('watch|/watch', UserController::class.'@watch');

$botman->hears('send|/send', UserController::class.'@send');

$botman->hears('broadcast|/broadcast', UserController::class.'@broadcast');

$botman->hears('str|/str|stregth|/str', UserController::class.'@strength');

$botman->hears('votes|/votes', UserController::class.'@votes');
