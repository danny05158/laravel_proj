<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Classes\Res_Cleanup;
use App\Classes\TickerNewsV2;
use App\Classes\TickerDetails;
use App\Classes\OpenClose;

class DashboardController
{

    public function __construct (){
        $this->ticker_simbol = null;
        $this->params = ['perpage' => 5, 'page' => 1];
        $this->response = [];
    }

    public function index(){
         return view('dashboard');
    }

    public function main(Request $request){

        $this->ticker_simbol = strtoupper(trim($request->input('website')));

        $res = new TickerNewsV2(['ticker' => $this->ticker_simbol]);
        $res->buildQuery();
        $arr = $res->getNews();

        $res = new Res_Cleanup($arr);
        $data = $res->cleanup_res();

        $this->stck_details();
        $this->response['news'] = $data;

        // $opn = new OpenClose();
        // $opn->getTckr($this->ticker_simbol);
        // $response = $opn->getPrices();

        // if($response['success']){
        //     $this->response['open'] = $response['openP'];
        // }

        return view('news', $this->response);
    }

    public function stck_details(){
        $details = new TickerDetails($this->ticker_simbol);
        $details->buildParams();
        $det = $details->getDetails();

        foreach($det as $key => $val){
            $this->response[$key] = $val;
        }
    }

}
