<?php

namespace App\CrudServices\Services;
use App\Http\Requests\PostupdatingRequest;
use App\Models\Post;

class PostUpdateService extends UpdateService
{

    protected function getFailedMessage(): string
    {
        return "Failed update";
    }

    protected function getSuccessMessage(): string
    {
        return "updated";
    }
    protected function getModelFile()
    {
        return Post::class;
    }

    protected function setRequestFile()
    {
        return PostupdatingRequest::class;
    }
}
