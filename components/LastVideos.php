<?php namespace Frukt\Yt\Components;

use Cms\Classes\ComponentBase;
use Frukt\Yt\Models\Settings;
use Frukt\Yt\Models\YTVideo;

/**
 * LastVideos Component
 */
class LastVideos extends ComponentBase
{
    public $videos;

    public function componentDetails()
    {
        return [
            'name' => 'lastVideos Component',
            'description' => 'No description provided yet...'
        ];
    }

    public function defineProperties()
    {
        return [];
    }

    public function onRun()
    {
        $this->videos = YTVideo::active()
            ->orderBy('published_at', 'desc')
            ->take(Settings::get('yt_front_quantity', 3))
            ->get();
    }
}
