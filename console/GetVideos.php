<?php namespace Frukt\Yt\Console;

use Carbon\Carbon;
use Frukt\Yt\Models\Settings;
use Frukt\Yt\Models\YTVideo;
use Illuminate\Console\Command;

class GetVideos extends Command
{
    /**
     * @var string The console command name.
     */
    protected $name = 'youtube:getvideos';

    /**
     * @var string The console command description.
     */
    protected $description = 'Загружает последние видосы с ютубчика';

    /**
     * Execute the console command.
     * @return void
     */
    public function handle()
    {
        $apiKey = Settings::get('yt_api_key');
        $channelId = Settings::get('yt_channel_id');
        $quantity = Settings::get('yt_quantity', '4');

        if ($apiKey and $channelId) {
            $client = new \GuzzleHttp\Client();
            $res = $client->get('https://www.googleapis.com/youtube/v3/search', [
                'query' => [
                    'key' => 'AIzaSyC7GhVvphcz_ZcZhsgruWotqfV61i8daHg',
                    'channelId' => 'UCOr5c-C4USQaGo1K_kp3SaQ',
                    'part' => 'snippet,id',
                    'order' => 'date',
                    'maxResults' => 10
                ]
            ]);
            if ($res->getStatusCode() == 200) {
                $result = json_decode($res->getBody()->getContents());

                trace_log($result);
                foreach ($result->items as $item) {
                    $video = YTVideo::where('youtube_id', $item->id->videoId)->firstOrCreate([
                        'etag' => $item->etag,
                        'youtube_id' => $item->id->videoId,
                        'title' => $item->snippet->title,
                        'desc' => $item->snippet->description,
                        'published_at' => Carbon::parse($item->snippet->publishedAt),
                        'is_active' => true,
                    ]);

                    $file = (new \System\Models\File)->fromUrl($item->snippet->thumbnails->high->url);
                    $video->image()->add($file);
                }
            }
        }
    }

    /**
     * Get the console command arguments.
     * @return array
     */
    protected function getArguments()
    {
        return [];
    }

    /**
     * Get the console command options.
     * @return array
     */
    protected function getOptions()
    {
        return [];
    }
}
