<?php

namespace App\Classes;

class Res_Cleanup {

    public function __construct($res, $params = []) {

      $this->response = $res;
      $this->params = $params;
      $this->data = [];
    }

    public function cleanup_res() : Array  {

      list($param_one, $param_two, $param_three, $param_four) = $this->params;


        foreach($this->response as $res){

          $obj = new \stdClass;

          $obj->$param_one = $res[$param_one];
          $obj->$param_two = $res[$param_two];
          $obj->$param_three = $res[$param_three];
          $obj->$param_four = $res[$param_four];

          $timestamp = $res['timestamp'];
          $this->data[$timestamp] = $obj;
        }

        return $this->data;
    }


}
