<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Spatie\Sitemap\SitemapGenerator;
use Spatie\Sitemap\SitemapIndex;
use Spatie\Sitemap\Sitemap;
use Spatie\Sitemap\Tags\Url;

use App\Channel;

use Carbon\Carbon;

use Storage;

class GenerateSitemap extends Command
{
    /**
     * The console command name.
     *
     * @var string
     */
    protected $signature = 'sitemap:generate';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Generate the sitemap.';

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $channels = Channel::all();

        $sitemap = Sitemap::create()
            ->add(Url::create('/'))
            ->add(Url::create('/onthisday'));

        $channels->each(function (Channel $channel) use ($sitemap) {
            $sitemap->add(Url::create("/{$channel->slug}")
                    ->setChangeFrequency(Url::CHANGE_FREQUENCY_DAILY)
                    ->setPriority(1));

        });

        $sitemap->writeToFile(public_path('sitemap-channels.xml'));

        $sitemapIndex = SitemapIndex::create();

        $sitemapIndex->add('/sitemap-channels.xml');

        if (!file_exists(public_path('sitemaps/'))) {
            mkdir(public_path('sitemaps/'), 0755, true);
        }

        foreach ($channels as $channel) {
            $sitemap = Sitemap::create();

            $i = 1;
            $sitecount = 1;

            $sitemapIndex->add('/sitemaps/channel-'.$channel->slug.'-'.$sitecount.'.xml');

            foreach ($channel->videos as $video) {

                $sitemap->add(Url::create("/{$video->channel->slug}/{$video->slug}")
                    ->setLastModificationDate(Carbon::parse($video->upload_date))
                    ->setChangeFrequency(Url::CHANGE_FREQUENCY_WEEKLY)
                    ->setPriority(0.8));

                if ($i >= 5000) {
                    $sitemap->writeToFile(public_path('sitemaps/channel-'.$channel->slug.'-'.$sitecount.'.xml'));
                    $sitemapIndex->add('/sitemaps/channel-'.$channel->slug.'-'.$sitecount.'.xml');


                    $sitecount++;
                    $i = 0;
                }

                $i++;

            }

            $sitemap->writeToFile(public_path('sitemaps/channel-'.$channel->slug.'-'.$sitecount.'.xml'));

        }

        $sitemapIndex->writeToFile(public_path('sitemap.xml'));

    }
}