<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');


class Stock extends MY_Model{
    const DB_TABLE = 'trades';
    const DB_TABLE_PK = 'id'; //primary key
    
    public $id;
    public $user_id;
    public $portfolio_id;
    public $symbol;
    public $purchase_time;
    public $purchase_price;
    public $shares;
    public $sale_time;
    public $sale_price;
    
   //public $stocks=array();
    public $yahoo_base_url = "http://finance.yahoo.com/webservice/v1/";
    
    public function __construct(){
        parent::__construct();
       
    }
    
    public function live_price($stocks=array()){
        $url = $this->yahoo_base_url . "symbols/";
        $num_stocks = count($stocks);
        
            for($i=0;$i<$num_stocks; $i++){
               if($i<$num_stocks-1){
                    $url .= $stocks[$i].",";
                }else{
                    $url .= $stocks[$i]."/";
                }
            }
            $url .= "quote?format=json";
            $ch = curl_init($url);
	        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);	    
	        $results = json_decode(curl_exec($ch), true);
	        $quotes=$results['list']['resources'];
	        for($i=0;$i<count($quotes); $i++){
	            $quotes_array["{$i}"] = $quotes["{$i}"]['resource']['fields'];
	        }
	        return ($quotes_array);
    }
    
    public function buy($symbol=""){
        $url = $this->yahoo_base_url . "symbols/";
        $url .= $symbol."quote?format=json";
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);	    
        $results = json_decode(curl_exec($ch), true);
        $quotes=$results['list']['resources'];
        return ($quotes[0]);
    }
}
    
