<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

require __DIR__ . '/../../../vendor/autoload.php';
use PolygonIO\rest\Rest;
use App\Classes\Res_Cleanup;

use App\Classes\TickerNewsV2;

class DashboardController extends Controller
{

    public function __construct (){
        $this->rest = null;
        $this->ticker_simbol = null;
        $this->params = ['perpage' => 5, 'page' => 1];
        $this->response = [];
    }


    public function load_api_key(){
        $this->rest = new Rest('0vuALpjDqJ_XmYXC8mU_pw92V9D879OZ');
    }

    public function index(){
         return view('dashboard');
    }

    public function get_open_close(){

        $this->rest = new Rest('0vuALpjDqJ_XmYXC8mU_pw92V9D879OZ');

        $ticker = trim(strtoupper($this->ticker_simbol));
        $tdate = date("Y-m-d", strtotime("-1 day"));

        try {
            $open_close = $this->rest->stocks->dailyOpenClose->get($ticker, $tdate);

        } catch (\Throwable $th) {
           echo $th->getMessage() . PHP_EOL;
           return redirect('/');
        }

        $res = new Res_Cleanup($open_close, ['open', 'close']);
        $obj = $res->sing_cleanup();

        $this->response['daily_open_close'] = $obj;
    }


    public function main(Request $request){

        $this->ticker_simbol = strtoupper(trim($request->input('website')));
        $this->get_open_close();


        $tdate = date("Y-m-d");
        $res = new TickerNewsV2(['ticker' => $this->ticker_simbol, 'tdate' => $tdate]);
        $res->buildQuery();
        $arr = $res->getNews();

        $res = new Res_Cleanup($arr, ['title', 'article_url', 'description', 'image_url']);
        $data = $res->cleanup_res();

        $this->response['news'] = $data;
        $this->response['ticker_simbol'] = $this->ticker_simbol;

        return view('news', $this->response);
    }

}
