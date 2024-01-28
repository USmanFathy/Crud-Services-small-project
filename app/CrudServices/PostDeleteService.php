<?php

namespace App\CrudServices;
use App\CrudServices\Services\DeleteService;

class PostDeleteService extends DeleteService
{

    public function getFailedMessage(): string
    {
        return "Failed Delete";
    }

    public function getSuccessMessage(): string
    {
        return "Deleted";
    }

}
