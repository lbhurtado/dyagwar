<?php

namespace Dyagwar\Domain\Conversations;

use BotMan\BotMan\Messages\Incoming\Answer;
use BotMan\BotMan\Messages\Outgoing\Question;
use BotMan\BotMan\Messages\Conversations\Conversation;

class WatchConversation extends Conversation
{
	protected $task;

	protected $tasks;

	protected $choices;

	protected $checklist;
    /**
     * Start the conversation.
     *
     * @return mixed
     */
    public function run()
    {

    	$this->tasks = config('watcher.tasks');

		$this->showIndex();
    }

    public function showIndex()
    {
		$keys = collect($this->tasks)->keys();

		$this->choices = $keys->toArray();

		$keywords = $keys->map(function ($item, $key) { 
			$index = (int) $key + 1;
			return $index .') '. $this->tasks[$item]['display'];
		})->implode("\n");

		$question = Question::create($keywords);

		$this->ask($question, function (Answer $answer) {
			$index = (int) $answer->getText() - 1;
			$this->task = $this->choices[$index];
			// $this->bot->reply($this->tasks[$this->task]['description']);

			$this->showChecklist();
		});
    } 

	public function showChecklist()
	{
		$keys = collect($this->tasks[$this->task]['checklist'])->keys();

		$this->choices = $keys->toArray();

		$keywords = $keys->map(function ($item, $key) { 
			$index = (int) $key + 1;
			return $index .') '. $this->tasks[$this->task]['checklist'][$item];
		})->implode("\n");

		$question = Question::create($keywords);

		$this->ask($question, function (Answer $answer) {
			$index = (int) $answer->getText() - 1;
			$this->checklist = $this->choices[$index];
			// $this->bot->reply($this->checklist);

			$this->showAlarms();
		});
	}

	public function showAlarms()
	{
		// dd($this->tasks[$this->task]);
		$keys = collect($this->tasks[$this->task]['alarms'])->keys();

		// dd($keys);
		$this->choices = $keys->toArray();

		$keywords = $keys->map(function ($item, $key) { 
			$index = (int) $key + 1;
			return $index .') '. $this->tasks[$this->task]['alarms'][$item];
		})->implode("\n");

		$this->bot->reply($keywords);
	}
}
