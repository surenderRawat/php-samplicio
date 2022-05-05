<?php
/**
 * Created by IntelliJ IDEA.
 * User: admin
 * Date: 07-03-2019
 * Time: 17:36
 */

namespace Samplicio\Samplicio;


Abstract class FulcrumModel implements FulcrumModelInterface
{
    use FulcrumResponseHelper;
    const GET = 'GET';
    const POST = 'POST';
    const PUT = 'PUT';
    const DELETE = 'DELETE';

    protected $fillable = [];
    protected $fulcrumRequest;
    public static $message = null;

    public function __construct(array $data = [])
    {   if(!empty($data))
        return $this->setValues($data);

        $this->fulcrumRequest = new FulcrumRequest();
    }

    protected function getStatic() {
        // gets THIS class of instance of object
        // that extends class in which is definied function
        return static::class;
    }

    public function setValues(array $data){
        foreach ($data as $key => $value){
            $this->{$key} = $value;
        }
        return $this;
    }

    public static function create(array $data){
        $static = (new static);
        $response = $static->fulcrumRequest
            ->makeReuest(self::POST, $static->setEndPoint()."Create",$data);
        static::$message = $response['message'] ?? null;
        return $static->setResponse($response);

    }

    public function update($id = null, array $data = [])
    {
        $response = $this->fulcrumRequest->makeReuest(self::PUT, $this->setEndPoint().($id ? 'Update/'.$id : "Update/0"),
                    $data);
        return $this->setResponse($response);

    }

    public function get(){
        $response =$this->fulcrumRequest
            ->makeReuest(self::GET, $this->setEndPoint());
        return $this->setResponse($response);
    }

    public static function find($id = null)
    {
        $static = (new static);
        $response = $static->fulcrumRequest
            ->makeReuest(self::GET, $static->setEndPoint().'/'.$id);
        return $static->setResponse($response);
    }

    public static function all()
    {
        $static = (new static);
        $response =$static->fulcrumRequest
            ->makeReuest(self::GET, $static->setEndPoint());
        return $static->setResponse($response);

    }

    public function delete($id = null)
    {
        try {
            $response =$this->fulcrumRequest
                ->makeReuest(self::DELETE, $this->setEndPoint().($id ? '/'.$id : ""));
            return $this->setResponse($response);
        }catch (\Exception $e){
            abort($this->httpStatus??500, $e->getMessage());
        }
    }

    abstract protected function setEndpoint();
    abstract protected function setResponseKey();

}
