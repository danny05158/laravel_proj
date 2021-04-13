<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

require __DIR__ . '/../../../vendor/autoload.php';
use PolygonIO\rest\Rest;

class DashboardController extends Controller
{

    public function __construct (){
        $this->rest = new Rest('0vuALpjDqJ_XmYXC8mU_pw92V9D879OZ');
        $this->params = ['perpage' => 15, 'page' => 1];
    }

    public function index(){
         return view('dashboard');
    }

    public function get_website(Request $request){

        $data = [];
        $response = [];

        $ticker_simbol = $request->input('website');

        $res = $this->rest->reference->tickerNews->get($ticker_simbol, $this->params);

        if(empty($res)){
            return redirect('dashboard');
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

        // $response['news'][] = $data;

        // $res = $rest->forex->realTimeCurrencyConversion->get($us, $eu, $ten);
        // $response['request'] = $request->input('website');

        $response['ticker_simbol'] = $ticker_simbol;
        $response['news'] = $data;
        return view('news', $response);

    }

}
