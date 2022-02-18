<?php namespace Frukt\Yt;

use Frukt\Yt\Components\LastVideos;
use System\Classes\PluginBase;

class Plugin extends PluginBase
{
    public function registerComponents()
    {
        return [
            LastVideos::class => 'lastVideos'
        ];
    }

    public function registerSettings()
    {
        return [
            'settings' => [
                'label' => 'YT Настройки',
                'description' => 'Управляйте настройками показа YT видосов.',
                'category' => 'YouTube',
                'icon' => 'icon-cog',
                'class' => \Frukt\Yt\Models\Settings::class,
                'order' => 500,
                'keywords' => 'youtube',
                'permissions' => [
                ]
            ]
        ];
    }

    public function register()
    {
        $this->registerConsoleCommand('youtube.getvideos', 'Frukt\Yt\Console\GetVideos');
    }

    public function registerSchedule($schedule)
    {
        $schedule->command('youtube:getvideos')->hourly();
    }
}
