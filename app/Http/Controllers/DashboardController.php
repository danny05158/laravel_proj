<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

require __DIR__ . '/../../../vendor/autoload.php';
use PolygonIO\rest\Rest;
use App\Classes\Res_Cleanup;

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

    public function get_website(Request $request){

        $this->load_api_key();

        //get form input
        $this->ticker_simbol = trim($request->input('website'));

        try {
            $res = $this->rest->reference->tickerNews->get($this->ticker_simbol, $this->params);

        } catch (\Throwable $th) {
            echo 'error' . $th;
        }
        $this->get_open_close();


        //if ticker is not right redirect home
        if(empty($res)){
            return redirect('/');
        }

        $res = new Res_Cleanup($res, ['title', 'url', 'summary', 'image']);
        $data = $res->cleanup_res();

        $this->response['ticker_simbol'] = $this->ticker_simbol;
        $this->response['news'] = $data;
        return view('news', $this->response);

    }

    public function get_open_close(){

        $ticker = trim(strtoupper($this->ticker_simbol));
        $tdate = date("Y-m-d", strtotime("-2 day"));

        try {
            $open_close = $this->rest->stocks->dailyOpenClose->get($ticker, $tdate);

        } catch (\Throwable $th) {
            echo 'error' . $th;
        }

        $res = new Res_Cleanup($open_close, ['open', 'close']);
        $obj = $res->sing_cleanup();

        $this->response['daily_open_close'] = $obj;
    }

}
