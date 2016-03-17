<?php defined( 'BASEPATH') OR exit( 'No direct script access allowed'); ?>
<!doctype html>

<div id='page-wrapper'>
    <div class="row">
        <h3>Portfolio Details</h3>
        <?php echo anchor( 'portfolios', 'All Portfolios');?>
        <br>
        <table>

            <tr>
                <th>Portfolio Name:</th>
                <td>
                    <?php echo $portfolio->portfolio_name;?></tr>
            </td>
            <tr>
                <th>Stocks + Cash: </th>
                <td>
                    <?php echo print_money($outstanding_stock_value+$portfolio->current_cap);?></td>
            </tr>
            <tr>
                <th>Cash: </th>
                <td>
                    <?php echo print_money($portfolio->current_cap);?></td>
            </tr>
            <tr>
                <th>Stocks: </th>
                <td>
                    <?php echo print_money($outstanding_stock_value);?>
                </td>
            </tr>
            <tr>
                <th>Gains: </th>
                <td>
                    <?php echo $gains;?>
                </td>
            </tr>
        </table>
    </div>
    <h3>Pick some Stocks Fool</h3>
    <div class="stock-query">
        <?php echo form_open( "portfolios/view/{$this->uri->segment(3)}"); $data=array( 'id'=>'stocks', 'value' =>'', 'style' =>'', 'type' =>'text'); $num_stocks = 5; for($i=0;$i
        <$num_stocks;$i++){ echo form_input(array_merge($data, array( 'name'=>"stock{$i}"))); } echo "
            <br>".form_submit('submit_stock_query', 'Get Prices'); echo form_close(); ?>
    </div>
    <?php if($this->input->post('submit_stock_query')):?>
    <h3>Buy Some Stocks Fool</h3>
    <?php $this->table->set_heading(array_keys($stocks_query[0]));
    $this->table->set_template(array('table_open'=>"<table class='table table-striped table-bordered table-hover'>"));
    echo $this->table->generate($stocks_query);?>
    <?php endif;?>

    <?php //if(count($porfolio_stocks)>0):?>
    <div class="row">
        <h3>Outstanding Stocks</h3>
        <table class ="table table-striped table-bordered table-hover" id="dataTables-example">
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
            <?php $current_price=$this->stock->get_price($stock->symbol); $purchase_price = $stock->purchase_price; $shares = $stock->shares; $gains = $shares*($current_price-$purchase_price); $sell_form = form_open('portfolios/sell') .form_hidden('trade_id', $stock->id) .form_hidden('portfolio_id',
            $this->uri->segment(3)) .form_hidden('current_val', $current_price) .form_submit('sell_stock', 'Sell') .form_close(); ?>
            <tr>
                <td></td>
                <td>
                    <?php echo $stock->symbol; ?></td>
                <td>
                    <?php echo $shares;?>
                </td>
                <td>
                    <?php echo print_money($purchase_price); ?>
                </td>
                <td>
                    <?php echo print_money($current_price); ?>
                </td>
                <td>
                    <?php echo print_money($current_price*$shares);?>
                </td>
                <td>
                    <?php echo print_money($gains);?>
                </td>
                <td>
                    <?php echo $sell_form;?>
                </td>
            </tr>
            <?php endforeach;?>
        </table>
    </div>
    <div class="row">
        <h3>Closed Trades</h3>
        <?php echo $historical_trades;?>
    </div>
</div>
    <div id="dom-target" style="display: none;">
    <?php echo htmlspecialchars($chart_vars); ?>
    </div>
    <div id="myfirstchart">
    </div>

    <?php// preprint($chart_vars);?>
    <script>

    </script>