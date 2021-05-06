<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

require __DIR__ . '/../../../vendor/autoload.php';
use PolygonIO\rest\Rest;
use App\Classes\Res_Cleanup;
use App\Classes\TickerNewsV2;
use App\Classes\TickerDetails;

class DashboardController extends Controller
{

    public function __construct (){
        $this->ticker_simbol = null;
        $this->params = ['perpage' => 5, 'page' => 1];
        $this->response = [];
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

        $res = new TickerNewsV2(['ticker' => $this->ticker_simbol]);
        $res->buildQuery();
        $arr = $res->getNews();

        $res = new Res_Cleanup($arr, ['title', 'article_url', 'description', 'image_url', 'author']);
        $data = $res->cleanup_res();

        $this->details();

        $this->response['news'] = $data;
        $this->response['ticker_simbol'] = $this->ticker_simbol;

        return view('news', $this->response);
    }

    public function details(){
        $det = new TickerDetails($this->ticker_simbol);
        $det->buildParams();
        $det->getDetails();
    }

}
