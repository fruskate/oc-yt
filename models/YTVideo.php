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
        'youtube_id' => 'required|unique:frukt_yt_videos'
    ];

    protected $fillable = ['etag', 'youtube_id', 'title', 'desc', 'published_at', 'is_active'];

    public $attachOne = [
        'image' => \System\Models\File::class,
    ];

    public function scopeActive($query)
    {
        $query->where('is_active', 1);
    }
}
