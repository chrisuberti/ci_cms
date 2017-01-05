<?php $this->load->view('auth/dressings/header');?>
<?php $this->load->view('auth/dressings/navbar');?>

<div id="page-wrapper">
    <div class="row">
        <div class="col-lg-12">
            <h1 class = "page-header"><?php echo lang('index_heading');?></h1>
            <p><?php echo lang('index_subheading');?></p>
        </div>

    <div id="content-outer" class ="clear"><div id="content-wrapper">
        <div id="content"><div class="col-one">
            <h2>Add New Category</h2>
            <?php echo form_open('Blog/add_new_category');?>
            <?php 
            if(validation_errors()){echo validation_errors('<p class = "error">','</p>');}?>
            <?php if($this->session->flashdata('message')){echo '<p class="success">'.$this->session->flashdata('message').'</p>';}?>
            
            <p><label for="">Category Name</label>
            <input type="text" name="category_name"size="30"/></p>
            <br>
            <?php 
                echo form_reset('resetbtn', 'Reset');
                echo form_submit('submit', 'Add Category');
                echo form_close();
            ?>
            <hr>
            <h3>Existing Categories: </h3>
            <table>
                <tr>
                    <td></td>
                </tr>
            </table>
            <?php 
            $this->table->set_template(array('table_open'=>"<table class='table table-striped table-bordered table-hover' id='history_table'>"));
	    	$this->table->set_heading('Category Name', 'Slug', '', '');
            foreach($categories as $ex_cat){
                $form_delete = form_open('blog/add_new_category/delete/'.$ex_cat->id).form_submit('submit', 'Delete').form_close();
                $this->table->add_row($ex_cat->category_name, $ex_cat->slug,$form_delete);
            }
            echo $this->table->generate();
            ?>
            </div></div>
    </div></div>
    
</div></div>
</body>

<?php $this->load->view('auth/dressings/footer');?>


