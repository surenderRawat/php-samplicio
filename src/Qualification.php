<?php
/**
 * Created by IntelliJ IDEA.
 * User: admin
 * Date: 09-03-2019
 * Time: 14:15
 */

namespace Samplicio;
use Samplicio\Samplicio\FulcrumModel;

class Qualification extends FulcrumModel
{
    public static $countryID = 2;

    public static function createOrUpdateQualification(int $id = null, array $data)
    {
        
        if (is_null($id))
        abort(422, "Survey Id is required");

        $UQID = config("fulcrum.payloads.QualificationUQID");
        $CQID = config("fulcrum.payloads.QualificationCQID");

        if(in_array($data["QuestionID"], $UQID["".Qualification::$countryID.""])) {
            (new static)->update($id, $data);
        }else if(in_array($data["QuestionID"], $CQID["".Qualification::$countryID.""])) {
            $static = (new static);
            $response = $static->fulcrumRequest
                ->makeReuest(self::POST, $static->setEndPoint() . "Create/" . $id, $data);
            static::$message = $response['ApiMessages'] ?? [];
            return $static->setResponse($response);

        }
        
    }

    public static function create(array $data)
    {
        abort(422, "use createOrUpdateQualification instead of create");
    }

    protected function setEndpoint(){
        return "Demand/v1/SurveyQualifications/";
    }

    protected function setResponseKey(){
        return "Qualification";
    }

    public function delete($id = null){
        abort(422, "Delete is not available");
    }
    public function get(){
        abort(422, "Get is not available");
    }

    public static function all(){
        abort(422, "All is not available");
    }

    public function getPayload(){
        return config("fulcrum.payloads.qualifications");
    }


}
