<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

require __DIR__ . '/../../../vendor/autoload.php';
use PolygonIO\rest\Rest;

class DashboardController extends Controller
{

    public function __construct (){
        $this->rest = null;
        $this->ticker_simbol = null;
        $this->params = ['perpage' => 5, 'page' => 1];
    }

    public function load_api_key(){
        $this->rest = new Rest('0vuALpjDqJ_XmYXC8mU_pw92V9D879OZ');
    }

    public function index(){
         return view('dashboard');
    }

    public function get_website(Request $request){

        $data = [];
        $response = [];
        $this->load_api_key();

        //get form input
        $this->ticker_simbol = $request->input('website');
        $res = $this->rest->reference->tickerNews->get($this->ticker_simbol, $this->params);

        //if ticker is not right redirect home
        if(empty($res)){
            return redirect('/');
        }

        foreach($res as $news_data){

            $obj = new \stdClass;

            $obj->title = $news_data['title'];
            $obj->url = $news_data['url'];
            $obj->summary = $news_data['summary'];
            $obj->image = $news_data['image'];

            $timestamp = $news_data['timestamp'];
            $data[$timestamp] = $obj;
        }

        $response['ticker_simbol'] = $this->ticker_simbol;
        $response['news'] = $data;
        return view('news', $response);

    }

}
