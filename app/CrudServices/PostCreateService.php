<?php

namespace App\CrudServices;

use App\CrudServices\Services\CreateService;
use App\Http\Requests\PostStoringRequest;
use App\Models\Post;
use Illuminate\Database\Eloquent\Model;

class PostCreateService extends CreateService
{

    public function getFailedMessage(): string
    {
        return "Failed create";
    }

    public function getSuccessMessage(): string
    {
        return "Created";
    }
    public function getModelFile()
    {
        return Post::class;
    }

    public function setRequestFile()
    {
        return PostStoringRequest::class;
    }
}
