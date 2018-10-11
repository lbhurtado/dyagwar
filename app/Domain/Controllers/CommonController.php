<?php

namespace Dyagwar\Domain\Controllers;

use BotMan\BotMan\BotMan;
use Illuminate\Http\Request;
use Dyagwar\Http\Controllers\Controller;

class CommonController extends Controller
{
    public function help(BotMan $bot)
    {
		$commands = collect([
			'help' => 'list of commands',
			'stop' => 'stops the conversation',
			'join' => 'auto-registration',
			'info' => 'information about the campaign',

			'share' 	=> 'upload multimedia',
			'subscribe' => 'turn on/off news, bulletins and blogs',
			'survey' 	=> 'access specific intel questions',
			'update' 	=> 'updat personal attributes',
			'volunteer' => 'volunteer as pollwatcher',
			'watch' 	=> 'start poll-watching tasks',
			'send' 		=> 'person-to-person messaging via handle',
			'broadcast' => 'group messaging via group name',
			'stregth' 	=> 'current membership count by groups',
			'votes' 	=> 'quick-count by clustered precincts, polling centers, barangays, districts and LGUs',
		]);

		$bot->reply('These are the commands:');

		$keywords = $commands->map(function ($description, $command) { 
			return $command . ' - ' . $description;
		})->implode("\n");

	    $bot->reply($keywords);
    }

    public function stop(BotMan $bot)
    {
		$bot->reply('break, break...');
    }

    public function info(BotMan $bot)
    {
		$bot->reply('The quick brown fox...');
    }
}
