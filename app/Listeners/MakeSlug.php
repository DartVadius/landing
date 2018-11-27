<?php

namespace App\Listeners;

use App\Events\GalleryPost;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use IvanLemeshev\Laravel5CyrillicSlug\Slug;

class MakeSlug
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
     * @param  GalleryPost  $event
     * @return void
     */
    public function handle(GalleryPost $event)
    {
        $slug_maker = new Slug();
        if (!empty($event->gallery->slug)) {
            $event->gallery->slug = $slug_maker->make(strtolower($event->gallery->slug));
        } else {
            $event->gallery->slug = $slug_maker->make(strtolower($event->gallery->name));
        }

    }
}
