<?php
/**
 * Created by IntelliJ IDEA.
 * User: admin
 * Date: 09-03-2019
 * Time: 15:28
 */

namespace Samplicio;


use Samplicio\Samplicio\FulcrumModel;

class Quota extends FulcrumModel
{
    protected $endPoint = "Demand/v1/SurveyQuotas/";
    protected function setEndpoint(){
       return $this->endPoint;
    }

    protected function setResponseKey(){
       return "Quota";
    }

    public function delete($id = null){
        abort(422, "Delete is not available");
    }
    public static function createQuota($id = null, array $data)
    {
        $static = (new static);
        $response = $static->fulcrumRequest
            ->makeReuest(self::POST, $static->setEndPoint()."Create/".$id,$data);
        static::$message = $response['message'] ?? null;
        return $static->setResponse($response);
    }

    public static function create(array $data)
    {
        abort(422, "use createQuota instead of create");
    }

    public function get($id = null){
        if(is_null($id))
            abort(422, "Survey Id is required");

       $this->endPoint = "Demand/v1/SurveyQuotas/BySurveyNumber/".$id;
       return parent::get();
    }

    public static function all(){
        abort(422, "All is not available");
    }

    public function getPayload(){
        return config("fulcrum.payloads.quota");
    }
}
