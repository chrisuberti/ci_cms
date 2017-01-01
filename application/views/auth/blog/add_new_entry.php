<?php $this->load->view('blog/header');?>
<body>
    <div id="content-outer" class ="clear"><div id="content-wrapper">
        <div id="content"><div class="col-one">
            <h2>Add New Category</h2>
            <?php form_open('add-new-category');?>
            <?php 
            if(validation_errors()){echo validation_errors('<p class = "error">','</p>');}?>
            <?php if($this->session->flashdata('message')){echo '<p class="success">'.$this->session->flashdata('message').'</p>';}?>
            
            <p><label for="">Category Name</label>
            <input type="text" name="category_name"size="30"/></p>
            <br>
            <input class = "button" type="submit" Value="Submit"/>
            <input class = "button" type="reset" Value="Reset"/>
            </div></div>
    </div></div>
    
</body>