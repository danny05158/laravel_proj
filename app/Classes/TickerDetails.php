<?php

namespace App\Classes;
use App\Classes\TickerNewsV2;

class TickerDetails extends TickerNewsV2 {

  public function __construct($tickr){

    $res = $this->_getApi();
    $this->apiUrl = $res['apiUrl'];
    $this->apikey = $res['api_key'];
    $this->tickr = $tickr;
    $this->route = '';
  }

  public function buildParams(){
    $this->route =  $this->apiUrl . '/v1/meta/symbols/' . $this->tickr . '/company?&apiKey=' . $this->apikey;
    // echo $this->route . PHP_EOL;
  }

  public function getDetails(){

    $this->client = new \GuzzleHttp\Client();

      try {

        $res = $this->client->request('GET', $this->route);
        $contents = $res->getBody()->getContents();

      }catch (\Throwable $e) {
         echo $e->getMessage() . PHP_EOL;
      }

      $cont = json_decode($contents, true);
      // print_r($cont);
      // return $cont['results'];
  }
}
