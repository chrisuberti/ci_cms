<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');


class Stocks_model extends CI_Model{
    
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
            return $url;

        
        foreach($stocks as $stock){
            
        }
    }
}
    
