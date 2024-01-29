<?php
namespace App\CrudServices\Services;
use App\CrudServices\Interfaces\StoringInterface;
use App\Exceptions\CustomValidationException;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

abstract class CreateService implements StoringInterface
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
    public abstract function getFailedMessage():string;
    public abstract function getSuccessMessage():string;
    public abstract function setRequestFile();
    public abstract function getModelFile();
    public function __construct()
    {
        $this->setSuccesMessage($this->getSuccessMessage());
        $this->setFailMessage($this->getFailedMessage());
        $this->setRequest($this->setRequestFile());
        $this->setModel($this->getModelFile());
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

    public function setModel(string $model): void
    {
        $this->model = $model;
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

    public function create(){
        $request = \request();
        $data =$this->valdiate($request);

        try {
            DB::beginTransaction();
            resolve($this->getModel())->create($data);
            DB::commit();

            return $this->message($this->getSuccesMessage());

        }catch (\Exception $e){
            DB::rollBack();
            throw new \Exception($e->getMessage());


        }
    }
}
