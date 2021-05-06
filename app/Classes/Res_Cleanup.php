<?php

namespace App\Classes;

class Res_Cleanup {

    public function __construct($res, $params = []) {

      $this->response = $res;
      $this->params = $params;
      $this->data = [];
    }

    public function cleanup_res() {

      list($param_one, $param_two, $param_three, $param_four, $param_five) = $this->params;

        foreach($this->response as $res){

          $obj = new \stdClass;

           $obj->$param_one = $res[$param_one];
           $obj->$param_two = $res[$param_two];
           $obj->$param_three = $res[$param_three];
           $obj->$param_four = $res[$param_four] ?? null;
           $obj->$param_five = $res[$param_five];

           $id = $res['id'];
           $this->data[$id] = $obj;
          }

        return $this->data;
    }

    public function sing_cleanup() {

      list($param_one, $param_two) = $this->params;
      $obj = new \stdClass;

      $obj->$param_one = $this->response[$param_one];
      $obj->$param_two = $this->response[$param_two];
      $this->data = $obj;

      return $this->data;
    }


}
