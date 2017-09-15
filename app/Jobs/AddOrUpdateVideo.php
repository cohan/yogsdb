<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

use App\Service\YT;

class AddOrUpdateVideo implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $youtube_id, $latestOnly;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($youtube_id = null, $latestOnly = null)
    {
        // TODO: Better exception class
        if (!$youtube_id) { throw new \Exception("YouTube ID is required"); }
        $this->youtube_id = $youtube_id;
        $this->latestOnly = $latestOnly ?: null;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        //
        YT::addOrUpdateVideo($this->youtube_id, $this->latestOnly);
    }
}
