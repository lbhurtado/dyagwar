<?php

namespace Dyagwar\Domain\Conversations;

use Illuminate\Support\Facades\Storage;
use BotMan\BotMan\Messages\Incoming\Answer;
use BotMan\BotMan\Messages\Outgoing\Question;
use BotMan\BotMan\Messages\Outgoing\Actions\Button;
use BotMan\BotMan\Messages\Outgoing\OutgoingMessage;
use BotMan\BotMan\Messages\Conversations\Conversation;

class ShareConversation extends Conversation
{
	protected $itemsToShare = [
	        'picture',
	        'video',
	        'audio',
	        'location',
	        'file',
	        'intel',
		];

    public function run()
    {
		$items = collect($this->itemsToShare);

		$keywords = $items->map(function ($item, $key) { 
			$index = (int) $key + 1;

			return $index .') '.$item;
		})->implode("\n");

	    $question = Question::create($keywords);

		$this->ask($question, function (Answer $answer) {
            switch ($answer->getText()) {
                case '1':
                    $this->say('Let\'s play Ultra Lotto 6/58!');
                    break;
                case '2':
                    $this->say('Let\'s play Grand Lotto 6/55!');
                    break;
                case '3':

            		return $this->askForAudio('Please upload an audio file.', function ($audio) {
            			Storage::disk('local')->put('test_audio.mp3', $audio[0]->getUrl());
        				$this->bot->reply(OutgoingMessage::create('Received audio...')
        					->withAttachment($audio[0]));
    				});
                    break;
                case '4':
                    $this->say('Let\'s play Mega Lotto 6/45!');
                    break;
                case '5':
                    $this->say('Let\'s play Lotto 6/42!');
                    break;
                default:
                    $this->say('I am not sure what you meant. Can you try again?');
                    return $this->repeat();
            }
            return $this->bot->reply('share');
        });

        
    }
}
