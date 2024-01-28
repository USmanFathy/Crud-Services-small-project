<?php

namespace App\CrudServices\Services;

use App\CrudServices\Interfaces\DeletingInterface;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

abstract class DeleteService implements DeletingInterface
{
    /**
     * @var string
     */
    protected $succesMessage;
    /**
     * @var string
     */
    protected $failMessage ;

    /**
     * @var Model
     */
    protected $modelId;
    public function getFailedMessage():string{
        return "test";
    }
    public function getSuccessMessage():string{
        return "test";
    }

    public function __construct($modelId)
    {
        $this->setSuccesMessage($this->getSuccessMessage());
        $this->setFailMessage($this->getFailedMessage());
        $this->setModelId($modelId);
    }

    public function getSuccesMessage(): string
    {
        return $this->succesMessage;
    }

    public function setSuccesMessage(string $succesMessage): void
    {
        $this->succesMessage = $succesMessage;
    }

    public function getFailMessage(): string
    {
        return $this->failMessage;
    }

    public function setFailMessage(string $failMessage): void
    {
        $this->failMessage = $failMessage;
    }


    public function getModelId(): Model
    {
        return $this->modelId;
    }

    public function setModelId(Model $modelId): void
    {
        $this->modelId = $modelId;
    }
    private function message($data):array{

        return [
            'message' => $data
        ];
    }


    public function delete(){
        try {
            DB::beginTransaction();
            $this->getModelId()->delete();
            DB::commit();

            return response()->json($this->message($this->getSuccesMessage()) , 200);

        }catch (\Throwable$e){
            DB::rollBack();
            throw $e;


        }
    }

}
