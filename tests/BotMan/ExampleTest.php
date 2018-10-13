<?php

namespace Tests\BotMan;


use Tests\TestCase;
use Illuminate\Support\Collection;
use Illuminate\Foundation\Inspiring;
use BotMan\BotMan\Messages\Outgoing\Question;
use BotMan\BotMan\Messages\Outgoing\OutgoingMessage;

class ExampleTest extends TestCase
{
    public function setUp()
    {
        parent::setUp();

        Collection::macro('numberize', function () {
            $i = 1;
            return $this->map(function ($item, $key) use (&$i) { 
                return $i++ . ') ' . $key;
            })->implode("\n");
        });
    }

    public function testBasicTest()
    {
        $this->bot
            ->receives('test')
            ->assertReply('It works!');
    }

    /**
     * A conversation test example.
     *
     * @return void
     */
    public function testConversationBasicTest()
    {
        $quotes = [
            'When there is no desire, all things are at peace. - Laozi',
            'Simplicity is the ultimate sophistication. - Leonardo da Vinci',
            'Simplicity is the essence of happiness. - Cedric Bledsoe',
            'Smile, breathe, and go slowly. - Thich Nhat Hanh',
            'Simplicity is an acquired taste. - Katharine Gerould',
            'Well begun is half done. - Aristotle',
            'He who is contented is rich. - Laozi',
            'Very little is needed to make a happy life. - Marcus Antoninus',
            'It is quality rather than quantity that matters. - Lucius Annaeus Seneca',
            'Genius is one percent inspiration and ninety-nine percent perspiration. - Thomas Edison',
            'Computer science is no more about computers than astronomy is about telescopes. - Edsger Dijkstra',
        ];

        $this->bot
            ->receives('icebreaker')
            ->assertQuestion('Huh - you woke me up. What do you need?')
            ->receivesInteractiveMessage('quote')
            ->assertReplyIn($quotes);
    }

    /** @test */
    public function bot_keyword_help()
    {
        $this->bot
            ->receives('help')
            ->assertReply('These are the commands:')
            ;
    }

    /** @test */
    public function bot_keyword_stop()
    {
        $this->bot
            ->receives('stop')
            ->assertReply('break, break...')
            ;
    }

    /** @test */
    public function bot_keyword_info()
    {
        $this->bot
            ->receives('info')
            ->assertReply('The quick brown fox...')
            ;
    }


    /** @test */
    public function bot_keyword_join()
    {
        $this->bot
            ->receives('join')
            ->assertReply('Thank you for joining the campaign.')
            ;
    }

    /** @test */
    public function bot_keyword_share()
    {
        $outgoing = new OutgoingMessage('Please upload an audio file.');



        $this->bot
            ->receives('share')
            ->assertTemplate(Question::class)
            ->receives('2')
            ->assertTemplate(OutgoingMessage::class)
            ->receivesVideos()
            ;
    }

    /** @test */
    public function bot_keyword_watch()
    {

        $this->bot
            ->receives('watch')
            ->assertTemplate(Question::class)
            ->receives('2')
            ->assertTemplate(Question::class)
            ->receives('2')
            ;
    }
}
