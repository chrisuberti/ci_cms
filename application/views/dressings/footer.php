
    <!-- jQuery -->
    <script src='<?php echo asset_url()."bower_components/jquery/dist/jquery.min.js";?>'></script>

    <!-- Bootstrap Core JavaScript -->
    <script src='<?php echo asset_url()."bower_components/bootstrap/dist/js/bootstrap.min.js";?>'></script>

    <!-- Metis Menu Plugin JavaScript -->
    <script src='<?php echo asset_url()."bower_components/metisMenu/dist/metisMenu.min.js";?>'></script>

    <!-- Morris Charts JavaScript -->
    <script src='<?php echo asset_url()."bower_components/raphael/raphael-min.js";?>'></script>
    <?php if($charts === TRUE):?>
        <script src='<?php echo asset_url()."bower_components/morrisjs/morris.min.js";?>'></script>
        <script src='<?php echo asset_url()."js/morris-data.js";?>'></script>
    <?php endif;?>
    
        <!-- DataTables JavaScript -->
        <script src='<?php echo asset_url()."bower_components/datatables/media/js/jquery.dataTables.min.js";?>'></script>
        <script src='<?php echo asset_url()."bower_components/datatables-plugins/integration/bootstrap/3/dataTables.bootstrap.min.js";?>'></script>
    
        

    <!-- Custom Theme JavaScript -->
    <script src='<?php echo asset_url()."dist/js/sb-admin-2.js";?>'></script>
    <!-- UberCMS javascript file -->
    <script src='<?php echo asset_url()."js/main.js";?>'></script>

</body>

</html>
