<h3>Modificar datos Hoja de Costos N° <?php echo number_format($id,0,'','.') ?></h3>

<hr style="width:1000px;" />
<div id="contenidos">
<?php echo form_open_multipart(null, array('class' => 'form-horizontal','name'=>'form','id'=>'form')); ?>

    
   <div class="control-group">
		<label class="control-label" for="usuario">Impresión</label>
		<div class="controls">
			<select name="impresion">
                <option value="Interna" <?php if($fotomecanica->impresion=="Interna"){echo 'selected="selected"';}?>>Interna</option>
                <option value="Externa" <?php if($fotomecanica->impresion=="Externa"){echo 'selected="selected"';}?>>Externa</option>
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
         <input type="hidden" name="url" value="<?php echo base_url()."cotizaciones/hoja_de_costos_propia/".$id."/".$pagina;?>" />
			<input type="submit" value="Guardar" class="btn btn-default" />
		   
		</div>
	</div>
    
</div>