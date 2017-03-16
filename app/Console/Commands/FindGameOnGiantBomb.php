<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

use App\Game;

class FindGameOnGiantBomb extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'giantbomb:game {title : Game title}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Find a game named {title} on Giantbomb. Add if it doesnt exist.';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        //
        $gameName = $this->argument('title');


        $apiKey = env('GIANTBOMB_API');

        // Create a Config object and pass it to the Client
        $config = new \DBorsatto\GiantBomb\Config($apiKey);
        $client = new \DBorsatto\GiantBomb\Client($config);

        $giantBombGames = $client->getRepository('Game')->query()
        ->addFilterBy('name', $gameName)
        ->setParameter('limit', 5)
        ->setParameter('offset', 0)
        ->find();

        foreach ($giantBombGames as $giantBombGame) {
            try {
                $game = Game::where(['title' => $gameName])->firstOrFail();
                echo "Updating game ".$game->title."\n";
            }
            catch (\Exception $e) {
                $game = new Game();
                $game->title = $gameName;
                echo "Creating game ".$game->title."\n";
            }

            $game->slug = str_slug($game->title);
            $game->giantbomb_id = $giantBombGame->api_detail_url;

            $game->description = $giantBombGame->deck;

            $game->aliases = $giantBombGame->aliases;

            if (empty($giantBombGame->image['super_url'])) {
                $game->thumbnail = null;
            }
            else {
                $game->thumbnail = $giantBombGame->image['super_url'];
            }


            $game->save();
        }

    }
}
