<?php

namespace App\Classes;

class TickerNewsV2 {

   protected $API_URL = 'https://api.polygon.io';
   protected $api_key = '0vuALpjDqJ_XmYXC8mU_pw92V9D879OZ';

    public function __construct($params = []) {
      $this->ticker = $params['ticker'];
      $this->tdate = $params['tdate'];
    }

    public function buildQuery(){

      $params = [
        'limit' => 8,
        'order' => 'descending',
        'sort' => 'published_utc',
        'ticker' => $this->ticker,
        'published_utc.gte' => $this->tdate,
        'apiKey' => $this->api_key
      ];

      $this->route = $this->API_URL . '/v2/reference/news?' . http_build_query($params);
      echo $this->route . PHP_EOL;
    }

    public function getNews(){

      $this->client = new \GuzzleHttp\Client();

      try {

        $res = $this->client->request('GET', $this->route);
        $res->getStatusCode();
        $res->getHeaderLine('content-type');
        $contents = $res->getBody()->getContents();

      } catch (\Throwable $th) {
        echo 'could not retrieve news ' . PHP_EOL ;
      }
      $cont = json_decode($contents, true);
      return $cont['results'];
    }

  }
