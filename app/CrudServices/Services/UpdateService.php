<?php

namespace App\CrudServices\Services;

use App\CrudServices\Interfaces\UpdatingInterface;
use App\Exceptions\CustomValidationException;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

abstract class UpdateService implements UpdatingInterface
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
     * @var Model
     */
    protected $modelId;
    public abstract function getFailedMessage():string;
    public abstract function getSuccessMessage():string;
    public abstract function setRequestFile();
    public function __construct($modelId)
    {
        $this->setSuccesMessage($this->getSuccessMessage());
        $this->setFailMessage($this->getFailedMessage());
        $this->setRequest($this->setRequestFile());
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
        $validator = Validator::make($request->all(), resolve($this->getRequest())->rules());
        if ($validator->fails()) {
            throw new CustomValidationException($validator);
        }

        return $validator->validated();
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
