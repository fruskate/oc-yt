<?php namespace Frukt\Yt\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableCreateFruktYtVideos extends Migration
{
    public function up()
    {
        Schema::create('frukt_yt_videos', function($table)
        {
            $table->engine = 'InnoDB';
            $table->increments('id')->unsigned();
            $table->string('etag')->nullable();
            $table->string('youtube_id')->nullable();
            $table->string('title')->nullable();
            $table->string('desc')->nullable();
            $table->timestamp('published_at')->nullable();
            $table->boolean('is_active')->default(1);
            $table->timestamp('created_at')->nullable();
            $table->timestamp('updated_at')->nullable();
        });
    }
    
    public function down()
    {
        Schema::dropIfExists('frukt_yt_videos');
    }
}
