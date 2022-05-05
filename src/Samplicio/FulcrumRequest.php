<?php
/**
 * Created by IntelliJ IDEA.
 * User: admin
 * Date: 07-03-2019
 * Time: 17:36
 */

namespace Samplicio\Samplicio;
use GuzzleHttp\Client;

class FulcrumRequest extends Client
{
    private $headers = [];

    public function makeReuest($method, $endpoint,$options = []){
        try {
            $response =  $this->request($method, $this->endPoint($endpoint), ['json' => $options,
                "headers" => $this->getRequestHeaders()]);
            return json_decode($response->getBody()->getContents(), true);
        }catch (\Exception $e){
            dd($e, $options);
            abort( $e->getCode() ?? 500, json_decode($e->getResponse()->getBody(true))->message??"Server error!");
        }
    }

    public function setHeaders($headers){
        if(is_array($headers) && !empty($headers))
            $this->headers = $headers;
    }

    public function getRequestHeaders()
    {
        return array_merge([
            "Content-Type" => "application/json",
            'Authorization' => $this->getFulcrumKey(),
        ], $this->headers);
    }

    public function endPoint($endpoint){

        if (empty($endpoint))
            abort(422,'End point not provided');

        return $this->getBase().'/'.$endpoint;
    }

    private function getBase(){
        if(empty($value = config('fulcrum.base_url')))
            abort(422,'End point not provided');
        return $value;
    }

    private function getFulcrumKey(){
        if(empty($value = config('fulcrum.key')))
            abort(422,'Fulcrum key not provided');
        return $value;
    }
    /*private function getFulcrumId(){
        if(empty($value = config('fulcrum.organization_id')))
            abort(422,'fulcrum organization id not provided');
        return $value;
    }*/

}
