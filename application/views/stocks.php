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
    <div>
        <h3>Portfolio Details</h3>
        <?php echo anchor('portfolios', 'All Portfolios');?>
        <br>
        <table>
            
            <tr><th>Portfolio Name:</th><td><?php echo $portfolio->portfolio_name;?></tr></td>
            <tr><th>Stocks + Cash: </th><td><?php echo print_money($outstanding_stock_value+$portfolio->current_cap);?></td></tr>
            <tr><th>Cash: </th><td><?php echo print_money($portfolio->current_cap);?></td></tr>
            <tr><th>Stocks: </th><td><?php echo print_money($outstanding_stock_value);?></td></tr>
            <tr><th>Gains: </th><td><?php echo $gains;?></td></tr>
        </table>
    </div>
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
    
    <?php //if(count($porfolio_stocks)>0):?>
    <h3>Outstanding Stocks</h3>
    <table>
        <th>
            <td>Symbol</td>
            <td>Shares</td>
            <td>Purchase Price</td>
            <td>Current Price</td>
            <td>Current Value</td>
            <td>Gains</td>
            <td>Actions</td>
        </th>
        <?php //$this->table->set_heading(array_keys($portfolio_stocks[0]));?>
        <?php foreach($portfolio_stocks as $stock): ?>
        <?php 
        $current_price = $this->stock->get_price($stock->symbol); 
        $purchase_price = $stock->purchase_price;
        $shares = $stock->shares;
        $gains = $shares*($current_price-$purchase_price);
        $sell_form = form_open('portfolios/sell')
        .form_hidden('trade_id', $stock->id)
        .form_hidden('portfolio_id', $this->uri->segment(3))
        .form_hidden('current_val', $current_price)
        .form_submit('sell_stock', 'Sell')
        .form_close();
        ?>
        <tr>
            <td></td>
            <td><?php echo $stock->symbol; ?></td>
            <td><?php echo $shares;?></td>
            <td><?php echo print_money($purchase_price); ?></td>
            <td><?php echo print_money($current_price); ?></td>
            <td><?php echo print_money($current_price*$shares);?></td>
            <td><?php echo print_money($gains);?></td>
            <td><?php echo $sell_form;?></td>
        </tr>
        <?php endforeach;?>
    </table>
</body>
</html>