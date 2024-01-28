<?php

namespace App\CrudServices\Interfaces;

interface StoringInterface
{

    public function getFailedMessage(): string ;
    public function getModelFile();
    public function getSuccessMessage() : string ;
    public function setRequestFile() ;

}
