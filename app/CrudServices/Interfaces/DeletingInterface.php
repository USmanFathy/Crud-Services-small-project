<?php

namespace App\CrudServices\Interfaces;

interface DeletingInterface
{

    public function getFailedMessage(): string ;
    public function getSuccessMessage() : string ;

}
