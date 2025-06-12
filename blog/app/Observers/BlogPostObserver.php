<?php

namespace App\Observers;

use App\Models\BlogPost;
use Carbon\Carbon;

class BlogPostObserver
{

    public function created(BlogPost $blogPost): void
    {
        //
    }


    public function updated(BlogPost $blogPost): void
    {
        //
    }


    public function deleted(BlogPost $blogPost): void
    {
        //
    }


    public function restored(BlogPost $blogPost): void
    {
        //
    }


    public function forceDeleted(BlogPost $blogPost): void
    {
        //
    }

    /**
     * @param  BlogPost  $blogPost
     *
     */
    public function updating(BlogPost $blogPost)
    {
        $this->setPublishedAt($blogPost);

        $this->setSlug($blogPost);
    }

    /**
     * @param BlogPost $blogPost
     */
    protected function setPublishedAt(BlogPost $blogPost)
    {
        if (empty($blogPost->published_at) && $blogPost->is_published) {
            $blogPost->published_at = Carbon::now();
        }
    }

    /**
     * 
     * @param BlogPost $blogPost
     */
    protected function setSlug(BlogPost $blogPost)
    {
        if (empty($blogPost->slug)) {
            $blogPost->slug = \Str::slug($blogPost->title);
        }
    }
}