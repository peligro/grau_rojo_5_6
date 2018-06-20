<!DOCTYPE html>
<html lang="es">
	<head>
		<title><?php echo $this->layout->getTitle(); ?> 2017</title>
		<meta charset="utf-8" />
      	<link rel="shortcut icon" href="<?php echo base_url(); ?>public/backend/img/favicon.ico" />
       <meta name="language" content="Spanish" />
	<meta name="copyright" content="www.grauindus.cl" />
      <meta name="designer" content="" />
    <meta name="author" content="www.grauindus.cl" />
	
		<link rel="stylesheet" href="<?php echo base_url(); ?>public/backend/css/bootstrap-cerulean.min.css" />
		<link rel="stylesheet" href="<?php echo base_url(); ?>public/frontend/tablebootstrap/dist/bootstrap-table.css" />

		<link rel="stylesheet" href="<?php echo base_url(); ?>public/backend/css/admin.css" />
		
         <?php echo $this->layout->css; ?> 
				<script src="<?php echo base_url(); ?>public/backend/js/jquery-1.8.1.min.js"></script>
        <!--
<script src="<?php echo base_url(); ?>public/backend/js/jquery-ui-1.9.0.custom.min.js"></script>
-->
		<script src="<?php echo base_url(); ?>public/backend/js/bootstrap.min.js"></script>
        <script src="<?php echo base_url(); ?>public/frontend/tablebootstrap/dist/bootstrap-table.js"> 

        <script src="<?php echo base_url(); ?>public/backend/js/reloj.js"></script>
         <?php echo $this->layout->js; ?> 
        <script src="<?php echo base_url(); ?>public/frontend/js/funciones.js"></script>


		<!--[if IE 7]>
			<script src="<?php echo base_url(); ?>public/backend/js/backend/admin-ie7.js"></script>
		<![endif]-->		
		<script type="text/javascript">var webroot = '<?php echo base_url(); ?>';</script>
		 
        	<script type="text/javascript">
			$(document).ready(function(){
				    $("#padre .input-xlarge").click(function (e) {
                		alert($(this).parent());
            		});
					
					
				
			});
			 jQuery(document).ready
                (
                    function()
                    {
                        muestraReloj();
                    }
                );
		</script>
        
	</head>
        
        	<body>
		<div class="container" id="contenedor">
            
	
<div class="page-header">
       <a class="logo" href="<?php echo base_url(); ?>" title="Empresas Grau"><img src="<?php echo base_url(); ?>public/backend/img/logo_grau.png" width="150" height="50" /></a>
      </div>
                 <p>
        <h5 style="text-align: right;">
        <span>Lunes 23 de Marzo de 2015</span> || <span id="spanreloj"></span> || 
                                Bienvenid@ <span class="label label-info"><?php echo $this->session->userdata('nombre')?></span>