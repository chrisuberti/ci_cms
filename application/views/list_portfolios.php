<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<div id="page-wrapper">
    
    
    
    <h3>Portfolios:</h3>
    <hr>
    <?php if(!empty($portfolio_stocks)):?>
    
    <table class = "table table-striped table-bordered table-hover dataTable no-footer" style = "">
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
    <h4><?php echo anchor('portfolios/add', '+ Add New Portfolio');?></h4>
    
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
</div>