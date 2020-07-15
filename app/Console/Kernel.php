<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel {
	/**
	 * The Artisan commands provided by your application.
	 *
	 * @var array
	 */
	protected $commands = [
		//
		Commands\FetchYouTubeVideo::class ,
		Commands\FetchYouTubeChannel::class ,
		Commands\RefreshYouTubeChannels::class ,
		Commands\RefreshVideoData::class ,
		Commands\RefreshFreshVideos::class ,
		Commands\FindGameOnGiantBomb::class ,
		Commands\Tag\Playlist::class ,

		Commands\GenerateSitemap::class ,

	];

	/**
	 * Define the application's command schedule.
	 *
	 * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
	 * @return void
	 */
	protected function schedule(Schedule $schedule) {
		// $schedule->command('inspire')
		//          ->hourly();

		$schedule->command("channel:refresh")
		         ->cron("5,35 * * * *");

		// $schedule->command("video:fresh --days=2")
		//          ->daily()
		//          ->withoutOverlapping();

		// $schedule->command("video:fresh --days=14")
		//          ->weekly()
		//          ->withoutOverlapping();

		// $schedule->command("video:refresh --count=30")
		//          ->daily()
		//          ->withoutOverlapping();

		$schedule->command('backup:clean')->daily()->at('01:00');
		$schedule->command('backup:run')->daily()->at('02:00');
		$schedule->command('backup:monitor')->daily()->at('10:00');

		$schedule->command('sitemap:generate')->daily()->at('06:00');

		$schedule->command('horizon:snapshot')->everyFiveMinutes();
	}

	/**
	 * Register the Closure based commands for the application.
	 *
	 * @return void
	 */
	protected function commands() {
		require base_path('routes/console.php');
	}
}
