<?php

namespace App\CrudServices;
use App\CrudServices\Services\UpdateService;
use App\Http\Requests\PostUpdatingRequest;

class PostUpdateService extends UpdateService
{

    public function getFailedMessage(): string
    {
        return "Failed update";
    }

    public function getSuccessMessage(): string
    {
        return "updated";
    }
    public function setRequestFile()
    {
        return PostUpdatingRequest::class;
    }
}
