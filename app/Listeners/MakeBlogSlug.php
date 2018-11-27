<?php

namespace App\Listeners;

use App\Events\BlogPost;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use IvanLemeshev\Laravel5CyrillicSlug\Slug;

class MakeBlogSlug
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  BlogPost  $event
     * @return void
     */
    public function handle(BlogPost $event)
    {
        $slug_maker = new Slug();
        if (!empty($event->post->slug)) {
            $event->post->slug = $slug_maker->make(strtolower($event->post->slug));
        } else {
            $event->post->slug = $slug_maker->make(strtolower($event->post->title));
        }
    }
}
