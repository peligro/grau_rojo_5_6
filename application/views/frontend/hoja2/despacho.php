<h3>Modificar datos Hoja de Costos N° <?php echo number_format($id,0,'','.') ?></h3>

<hr style="width:1000px;" />
<div id="contenidos">
<?php echo form_open_multipart(null, array('class' => 'form-horizontal','name'=>'form','id'=>'form')); ?>

    
   <div class="control-group">
		<label class="control-label" for="usuario">Retira Cliente</label>
		<div class="controls">
            <select name="retira_cliente">
                <option value="">Seleccione.....</option>                
                <?php  if (sizeof($datos)>0) {   ?>
                    <option value="NO" <?php if($datos->retira_cliente=="NO"){echo 'selected="true"';}?><?php if($datos->retira_cliente==""){echo 'selected="true"';}?>>Despacho Empresa</option>
                    <option value="SI" <?php if($datos->retira_cliente=="SI"){echo 'selected="true"';}?>>SI, Retira Cliente</option>                    
                <?php } else {?>                    
                    <option value="SI" <?php if($_POST["retira_cliente"]=="SI"){echo 'selected="true"';}?>>SI, Retira Cliente</option>
                    <option value="NO" <?php if($_POST["retira_cliente"]=="NO"){echo 'selected="true"';}?>>Despacho Empresa</option>
                <?php } ?>                  
            </select>
        
		</div>
	</div>
     <div class="control-group">
		<label class="control-label" for="usuario">Justifique el cambio</label>
		<div class="controls">
			<textarea id="contenido6" name="glosa" placeholder="Justificación"></textarea>
		</div>
	</div>
    <hr />
      <div class="control-group">
		<div class="form-actions">
         <input type="hidden" name="id" value="<?php echo $id?>" />
         <input type="hidden" name="url" value="<?php echo base_url()."cotizaciones/hoja_de_costos2/".$id."/".$pagina;?>" />
			<input type="submit" value="Guardar" class="btn btn-default" />
		   
		</div>
	</div>
    
</div>