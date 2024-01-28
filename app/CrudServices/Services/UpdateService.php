<?php

namespace App\CrudServices\Services;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

abstract class UpdateService
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
     * @var string
     */
    protected $request ;
    /**
     * @var string
     */
    protected $model ;
    /**
     * @var Model
     */
    protected $modelId;
    protected function getFailedMessage():string{
        return "test";
    }
    protected function getSuccessMessage():string{
        return "test";
    }
    protected function setRequestFile(){

        return  ;
    }
    protected function getModelFile(){

        return ;
    }
    public function __construct($modelId)
    {
        $this->setSuccesMessage($this->getSuccessMessage());
        $this->setFailMessage($this->getFailedMessage());
        $this->setRequest($this->setRequestFile());
        $this->setModel($this->getModelFile());
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

    public function getRequest(): string
    {
        return $this->request;
    }

    public function setRequest(string $request): void
    {
        $this->request = $request;
    }

    public function getModel(): string
    {
        return $this->model;
    }

    public function setModel(string $model)
    {
        $this->model = $model;
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

    private function valdiate(Request $request){
        return $request->validate(resolve($this->getRequest())->rules());
    }

    public function update(){
        $request = \request();
        $data =$this->valdiate($request);

        try {
            DB::beginTransaction();
            $this->getModelId()->update($data);
            DB::commit();

            return response()->json($this->message($this->getSuccesMessage()) , 200);

        }catch (\Throwable$e){
            DB::rollBack();
            throw $e;


        }
    }

}
