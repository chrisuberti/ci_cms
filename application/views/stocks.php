<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Stock Tool</title>
</head>
<body>
    <h3>Pick some Stocks Fool</h3>
    <div class="stock-query">
    <?php 
    echo form_open("portfolios/view/{$this->uri->segment(3)}");
	    $data=array(
	    	'id' 	=>'stocks',
	    	'value' =>'',
	    	'style' =>'',
	    	'type' =>'text');
	    $num_stocks = 5; 
	    for($i=0;$i<$num_stocks;$i++){
	    	echo form_input(array_merge($data, array('name'=>"stock{$i}")));
	    }
	    echo "<br>".form_submit('submit_stock_query', 'Get Prices');
	    echo form_close();
    ?>    
    </div>
    <?php if($this->input->post('submit_stock_query')):?>
    <h3>Buy Some Stocks Fool</h3>
    <?php $this->table->set_heading(array_keys($stocks_query[0]));?>
    <?php echo $this->table->generate($stocks_query);?>
    <?php endif;?>
    
    <h3>Outstanding Stocks</h3>
    <?php if(!empty($porfolio_stocks)):?>
    <?php $this->table->set_heading(array_keys($porfolio_stocks[0]));?>
    <?php echo $this->table->generate($porfolio_stocks);?>
    <?php endif;?>
    
</body>
</html>