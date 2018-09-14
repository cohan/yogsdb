<?php

namespace App\Service;

use GuzzleHttp\Client;
use Illuminate\Support\Facades\Cache;

Class Twitch {


    public static function getLiveStreams() {
        $channels = self::getStreamChannels();

        $channel_ids = implode(",",array_pluck($channels->users, '_id'));

        $streams = Cache::remember('stream-livechannels', 10, function() use ($channel_ids) {
            return self::fetchFromTwitch('https://api.twitch.tv/kraken/streams',
                [
                    'channel' => $channel_ids,
                    'stream_type' => 'live'
                ]
            );
        });

        return collect($streams->streams);
    }

    public static function getStreamChannels() {
        $channels = Cache::remember('stream-channels', 60, function () {
            return self::fetchFromTwitch('https://api.twitch.tv/kraken/teams/yogscast');
        });

        return $channels;
    }

    public static function fetchFromTwitch($url, $params = []) {
        $client_id = config('twitch.client_id');

        $client = new Client();

        $query = http_build_query($params);

        $url = $url."?".$query;

        // Request gzipped data, but do not decode it while downloading
        $response = $client->request('GET', $url, [
            'headers'        => [
                'Accept' => 'application/vnd.twitchtv.v5+json',
                'Client-ID' => $client_id,
            ]
        ]);

        return json_decode($response->getBody());
    }
}