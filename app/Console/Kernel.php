<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
	/**
	 * The Artisan commands provided by your application.
	 *
	 * @var array
	 */
	protected $commands = [
		//
		Commands\FetchYouTubeVideo::class,
		Commands\FetchYouTubeChannel::class,
		Commands\RefreshYouTubeChannels::class,
		Commands\RefreshVideoData::class,
		Commands\RefreshFreshVideos::class,
		Commands\FindGameOnGiantBomb::class,
		Commands\Tag\Playlist::class,

		Commands\GenerateSitemap::class,

	];

	/**
	 * Define the application's command schedule.
	 *
	 * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
	 * @return void
	 */
	protected function schedule(Schedule $schedule)
	{
		// $schedule->command('inspire')
		//          ->hourly();

		$schedule->command("channel:refresh")
			->hourlyAt(10);

		$schedule->command("video:fresh")
			->hourlyAt(30);

		$schedule->command("video:fresh --days=7")
			->daily();

		$schedule->command("video:refresh --count=100")
			->hourlyAt(40);

		$schedule->command('backup:clean')->daily()->at('01:00');
		$schedule->command('backup:run')->daily()->at('02:00');
	}

	/**
	 * Register the Closure based commands for the application.
	 *
	 * @return void
	 */
	protected function commands()
	{
		require base_path('routes/console.php');
	}
}
