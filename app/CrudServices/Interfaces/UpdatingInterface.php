<?php

namespace App\CrudServices\Interfaces;

interface UpdatingInterface
{

    public function getFailedMessage(): string ;
    public function getSuccessMessage() : string ;
    public function setRequestFile() ;

}
