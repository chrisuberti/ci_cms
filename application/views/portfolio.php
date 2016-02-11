<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Portfolio Tool</title>
</head>
<body>
    <div class = "" id="add-portfolio-form">
        <?php //echo anchor('portfolios/add', '+ Create New Portfolio');?>
        <?php 
        echo form_open("Portfolios/add");
        echo form_input(array('name'=>'portfolio_name', 'placeholder'=>'Portfolio Name'));
        echo form_input(array('name'=>'portfolio_description', 'placeholder'=>'Portfolio Description', 'type'=>'textarea'));
        echo form_input(array('name'=>'beginning_cap', 'placeholder'=>'Starting Capital', 'type' => 'number'));
        $users = $this->ion_auth->users()->result();
        $user_input = [];
        foreach($users as $user){
            $user_input = array_merge($user_input, array($user->username => $user->first_name . " " . $user->last_name));
        }
        echo form_dropdown(array('name'=>'user_id'), $user_input);
        echo form_submit('submit', 'Add Portfolio');
        echo form_close();
        
        ?>
    </div>
    <h3>Pick some Stocks Fool</h3>
    <div class="stock-query">
    </div>
  
    
    
    <h3>Portfolios:</h3>
    <?php if(!empty($portfolio_stocks)):?>
    
    <table style = "">
        <th>
            <td>Portfolio</td>
            <td>Description</td>
            <td>Starting Capital</td>
            <td>Current Capital</td>
            <td>Starting Date</td>
            <td>Gains</td>
            <td>User</td>
        </th>
        <?php foreach($portfolio_stocks as $portfolio):?>
        <tr>
            <td></td>
            <td><?php echo $portfolio->portfolio_name;?></td>
            <td><?php echo $portfolio->portfolio_description;?></td>
            <td><?php echo $portfolio->beginning_cap;?></td>
            <td><?php echo $portfolio->current_cap;?></td>
            <td><?php echo $portfolio->starting_date;?></td>
            <?php $gains = ($portfolio->current_cap/$portfolio->beginning_cap)-1;?>
            <td><?php echo $gains;?></td>
            <?php $user = $this->ion_auth->user($portfolio->user_id)->row();?>

            <td><?php echo $user->first_name . " ". $user->last_name; ?></td>
            <td><?php echo anchor("portfolios/view/{$portfolio->id}", 'Details')?></td>
            <td><?php echo form_open('portfolios/delete/'.$portfolio->id);
                    echo form_submit('delete_portfolio', 'Delete');
                    echo form_close();
            ?></td>
        </tr>
        <?php endforeach;?>
    </table>
    <?php else: ?>
        <h3>Currently no portfolios setup</h3>
    <?php endif;?>
    
</body>
</html>



<?php
if(!empty($portfolios)){
			foreach($portfolios as $portfolio){
				echo "<h3>".$portfolio->name ."</h3>: " . $portfolio->id ."<br>";
				echo "<p>".$portfolio->beginning_cap ."</p><br>";
				echo form_open("portfolios/delete/{$portfolio->id}");
				echo form_submit('submit', 'Delete');
				echo form_close();
			}
		}
		?>