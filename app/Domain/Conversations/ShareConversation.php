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
	        // 'file',
	        // 'intel',
		];

	// protected function setFileSystemRoot()
	// {
	// 	config()->set('filesystems.disks.' . config('filesystems.default') . '.root', 'lester');
	// }
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
                    return $this->askForImages('Please upload an image.', function ($images) {
                    	$filename = pathinfo($images[0]->getUrl())['filename'];
						Storage::put($filename, $images[0]->getUrl());
    					$this->bot->reply(OutgoingMessage::create('Received image..'));
                    });
                    break;
                case '2':
            		return $this->askForVideos('Please upload a video file.', function ($video) {
            			$filename = pathinfo($video[0]->getUrl())['filename'];
            			Storage::put($filename, $video[0]->getUrl());
        				$this->bot->reply(OutgoingMessage::create('Received video...'));
    				});
                    break;
                case '3':
            		return $this->askForAudio('Please upload an audio file.', function ($audio) {
            			$filename = pathinfo($audio[0]->getUrl())['filename'];
            			Storage::put($filename, $audio[0]->getUrl());
        				$this->bot->reply(OutgoingMessage::create('Received audio...'));
    				});
                    break;
                case '4':
					return $this->askForLocation('Please tell me your location.', function (Location $location) {
    				
    					$this->bot->reply(OutgoingMessage::create('Received location...'));
    				});
                    break;
                // case '5':
                //     $this->say('Let\'s play Lotto 6/42!');
                //     break;
                default:
                    $this->say('I am not sure what you meant. Can you try again?');
                    return $this->repeat();
            }
            return $this->bot->reply('share');
        });

        
    }
}
