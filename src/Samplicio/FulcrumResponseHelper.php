<?php
/**
 * Created by IntelliJ IDEA.
 * User: admin
 * Date: 07-03-2019
 * Time: 17:37
 */

namespace Samplicio\Samplicio;


trait FulcrumResponseHelper
{
    public function setResponse(array $response){
        if(isset($this->fulcrumRequest))
             unset($this->fulcrumRequest);
        $collect = [];
        if(isset($response[$this->setResponseKey()])) {
            if(empty($response[$this->setResponseKey()]))
                return null;
            return $this->setValues($response[$this->setResponseKey()]);
        }elseif (isset($response[$this->setResponseKey().'s'])){
            if(empty($response[$this->setResponseKey().'s']))
                return collect($collect);
            foreach ($response[$this->setResponseKey().'s'] as $value){
                $classname = $this->getStatic();
                $collect[] = new $classname($value);
            }
            return collect($collect);
        }

        return $this;
    }

    public function toArray(){
        return json_decode(json_encode($this), true);
    }

    public function toJson(){
        return json_encode($this);
    }

}
