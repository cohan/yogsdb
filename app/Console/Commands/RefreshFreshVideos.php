<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

use Artisan;
use App\Video;

class RefreshFreshVideos extends Command
{
	/**
	 * The name and signature of the console command.
	 *
	 * @var string
	 */
	protected $signature = 'video:fresh {{--days= : How many days are considered fresh }}';

	/**
	 * The console command description.
	 *
	 * @var string
	 */
	protected $description = 'Update the latest video statistic data';

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
		$refreshDays = (int) $this->option('days');

		if (empty($refreshDays)) {
			$refreshDays = 1;
		}

		$videos = Video::where("upload_date", ">", date("Y-m-d H:i:s", strtotime("$refreshDays day ago")))->orderBy("updated_at", "desc")->get();

		foreach ($videos as $video) {

			echo "Refresh due for ".$video->title." uploaded ".$video->upload_date." last updated ".$video->updated_at."\n";

			Artisan::queue('video:import', [
				'videoid' => $video->youtube_id,
				]);

		}
	}
}
