<?php
/**
 * Created by IntelliJ IDEA.
 * User: admin
 * Date: 07-03-2019
 * Time: 17:55
 */

namespace Samplicio;


use Samplicio\Samplicio\FulcrumModel;

class Survey extends FulcrumModel
{
    private $setEndpoint = "Demand/v1/Surveys/";

    protected function setEndpoint()
    {
      return $this->setEndpoint;
    }

    protected function setResponseKey()
    {
       return "Survey";
    }

    public function get($status = 01)
    {
        $this->setEndpoint = "Demand/v1/Surveys/BySurveyStatus/".$status;
        return parent::get(); // TODO: Change the autogenerated stub
    }

    public static function find($id = null)
    {
        $static = (new static);
        $response = $static->fulcrumRequest
            ->makeReuest(self::GET, $static->setEndPoint().'BySurveyNumber/'.$id);
        return $static->setResponse($response);
    }

    public function update($id = null, array $data = [])
    {
        $survey = static::find($id)->toArray();
        $_data = array_merge($survey, $data);
        return parent::update($id, $_data); // TODO: Change the autogenerated stub
    }

    public static function all(){
        abort(422,"Function all not available");
    }

    public function delete($id = null)
    {
        abort(422,"Function delete not available");
    }

    public function getPayload(){
       return config("fulcrum.payloads.survey");
    }

    public function liveUrl($cnt_id = null){
        if(is_null($cnt_id))
            abort(422, "ContentId not provided!");
        return config('fulcrum.user_dashboard')."/#/user/main/Auth?&cnt_id=".$cnt_id."&r_id=[%RID%]&risn=[%RSFN%]&age=[%AGE%]&gender=[%GENDER%]&uni_user=false&fulcrum=true";
    }

    public function testUrl($cnt_id = null){
        if(is_null($cnt_id))
            abort(422, "ContentId not provided!");
        return config('fulcrum.user_dashboard')."/#/user/main/Auth?&cnt_id=".$cnt_id."&r_id=[%RID%]&risn=[%RSFN%]&age=[%AGE%]&gender=[%GENDER%]&uni_user=true&fulcrum=true";
    }
    public function liveCmpUrl($cmp_id = null){
        if(is_null($cmp_id))
            abort(422, "Campaign ID not provided!");
        return config('fulcrum.user_dashboard')."/#/user/main/Auth?&cmp_id=".$cmp_id."&r_id=[%RID%]&risn=[%RSFN%]&age=[%AGE%]&gender=[%GENDER%]&uni_user=false&fulcrum=true";
    }

    public function testCmpUrl($cmp_id = null){
        if(is_null($cmp_id))
            abort(422, "Campaign ID not provided!");
        return config('fulcrum.user_dashboard')."/#/user/main/Auth?&cmp_id=".$cmp_id."&r_id=[%RID%]&risn=[%RSFN%]&age=[%AGE%]&gender=[%GENDER%]&uni_user=true&fulcrum=true";
    }
}
