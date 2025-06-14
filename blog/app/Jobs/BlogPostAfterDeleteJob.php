<?php

namespace App\Jobs;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;

use Illuminate\Queue\SerializesModels;


class BlogPostAfterDeleteJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * @var int
     */
    private $blogPostId;

    public function __construct(int $blogPostId)
    {
        $this->blogPostId = $blogPostId;
    }

    public function handle(): void
    {
        logs()->warning("Видалено запис в блозі [{$this->blogPostId}]");
    }
}
