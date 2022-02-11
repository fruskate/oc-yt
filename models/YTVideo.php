<?php namespace Frukt\Yt\Models;

use Model;

/**
 * Model
 */
class YTVideo extends Model
{
    use \October\Rain\Database\Traits\Validation;


    /**
     * @var string The database table used by the model.
     */
    public $table = 'frukt_yt_videos';

    /**
     * @var array Validation rules
     */
    public $rules = [
        'youtube_id' => 'required|unique'
    ];
}
