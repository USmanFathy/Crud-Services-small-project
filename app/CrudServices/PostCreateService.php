<?php

namespace App\CrudServices;

use App\CrudServices\Services\CreateService;
use App\Http\Requests\PostRequest;
use App\Models\Post;
use Illuminate\Database\Eloquent\Model;

class PostCreateService extends CreateService
{

    protected function getFailedMessage(): string
    {
        return "Failed create";
    }

    protected function getSuccessMessage(): string
    {
        return "Created";
    }
    protected function getModelFile()
    {
        return Post::class;
    }

    protected function setRequestFile()
    {
        return PostRequest::class;
    }
}
