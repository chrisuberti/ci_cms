<div id="page-wrapper">
    <div class = "" id="add-portfolio-form">
        <?php //echo anchor('portfolios/add', '+ Create New Portfolio');?>
        <div class="page-header">
            
        <h3>Add Portfolio</h3></div>
        <div class="row">
        <div class="col-lg-6">
        <?php 
        echo form_open("Portfolios/add");
        echo form_input(array('name'=>'portfolio_name', 'placeholder'=>'Portfolio Name','value'=>set_value('portfolio_name')));
        ?>
        
        
        <div><h4>Select user that owns this Portfolio: </h4>
        <?php 
        $users = $this->ion_auth->users()->result();
        $user_input = [];
        foreach($users as $user){
            $user_input = array_merge($user_input, array(($user->id)+1 => $user->first_name . " " . $user->last_name));
        }
        echo br(1);
        echo form_dropdown(array('name'=>'user_id', 'value'=>set_value('user_id')), $user_input);
        ?> </div>
        <?php 
        echo br(1);
        echo form_textarea(array('name'=>'portfolio_description', 'placeholder'=>'Portfolio Description', 'type'=>'textarea', 'value'=>set_value('portfolio_description')));
        echo br(1);?>
        </div>
        
        
        <div class="col-lg-6">
            <div><h4>Enter you starting capital for the Portfolio</h4>
            <div class="input-group">
                <span class="input-group-addon">$</span>
                    <input type="number" class="form-control" aria-label="Amount (to the nearest dollar)" name='beginning_cap' placeholder = "Starting Capital" value=<?php set_value('beginning_cap');?>>
                <span class="input-group-addon">.00</span>
            </div></div>
            
            <div class = "row">
                <h4>Commisioned Porfolio:</h4>
                    <div class="input-group">
                      <span class="input-group-addon">
                        <input type="checkbox" aria-label="..." name = "commision_bool" value = 'TRUE'>
                      </span>
                      <input type="number" class="form-control" aria-label="..." name = "commision" value=<?php set_value('number'); ?>>
                    </div><!-- /input-group -->
                  </div><!-- /.col-lg-6 -->
                    <br>
            
        </div>
        </div>
        <div class="row">
        <?php
            echo form_submit('submit', 'Add Portfolio');
            echo form_close();
        ?>
        </div>
    </div>
    </div>
    