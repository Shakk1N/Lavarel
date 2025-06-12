<?php

namespace App\Observers;

use App\Models\BlogCategory;
use Illuminate\Support\Str;

class BlogCategoryObserver
{

    public function created(BlogCategory $blogCategory): void
    {
        //
    }


    public function updated(BlogCategory $blogCategory): void
    {
        //
    }


    public function deleted(BlogCategory $blogCategory): void
    {
        //
    }


    public function restored(BlogCategory $blogCategory): void
    {
        //
    }


    public function forceDeleted(BlogCategory $blogCategory): void
    {
        //
    }

    /**
     * @param  BlogCategory  $blogCategory
     *
     */
    public function creating(BlogCategory $blogCategory)
    {
        $this->setSlug($blogCategory);
    }

    public function updating(BlogCategory $blogCategory)
    {
        $this->setSlug($blogCategory);
    }
    /**
     * @param BlogCategory  $blogCategory
     */
    protected function setSlug(BlogCategory $blogCategory)
    {
        if (empty($blogCategory->slug)) {
            $blogCategory->slug = Str::slug($blogCategory->title);
        }
    }
}