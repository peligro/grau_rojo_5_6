<?php $this->layout->element('admin_mensaje_validacion'); ?>
<div id="contenidos">
<?php echo form_open(null, array('class' => 'form-horizontal','name'=>'form','id'=>'form')); ?>
  <!-- Migas -->
    <ol  class= "breadcrumb" >  
      <li><a href="<?php echo base_url()?>">Home &gt;&gt;</a></li>
      <?php
      switch($tipo)
      {
        case '1':
            ?>
            <li><a href="<?php echo base_url()?>produccion/cotizaciones/<?php echo $pagina?>">Órdenes de Producción &gt;&gt;</a></li>
            <li>Control Cartulina - Orden de Producción N° <?php echo $ordenDeCompra->id?></li>
            <?php
        break;
        case '2':
            ?>
            <li><a href="<?php echo base_url()?>produccion/fast/<?php echo $pagina?>">Fast Track &gt;&gt;</a></li>
            <li>Control Cartulina - Fast Track N° <?php echo $ordenDeCompra->id?></li>
            <?php
        break;
      }
      ?>
      
      
    </ol>
 
   <!-- /Migas -->

<div class="page-header">
                        <!--<div onclick="ver_informacion('informacion')" class="page-header">-->
                          <h3>Control Cartulina - Orden de Producción N° <?php echo $id?></h3>
</div>
<!--información encabezado-->
<div class="container">
  <div class="col-md-4" style="float: left;">
  <ul>
                           <?php
                            $cli=$this->clientes_model->getClientePorId($datos->id_cliente);
                            $cliente=$cli->razon_social;
                            $vendedor=$this->vendedores_model->getVendedorPorId($datos->id_vendedor);
//                            if($orden->tiene_molde=='NO')
//                            {
//                                $moldeNuevo='Molde Antiguo';
//                            }else
//                            {
//                                $moldeNuevo='Molde nuevo';
//                            }
                            if(($orden->tiene_molde=='SI') && ($orden->estan_los_moldes=='NO'))// CUANDO ES NUEVO Y NO ESTAN HECHOS LOS MOLDES
                            {
                                $moldeNuevo='Molde Nuevo';
                            }                    
                            elseif(($orden->tiene_molde=='SI') && ($orden->estan_los_moldes=='SI'))// CUANDO EXISTEN Y ESTAN HECHOS LOS MOLDES
                            {
                                $moldeNuevo='Molde Antiguo';
                            }
                            elseif(($orden->tiene_molde=='NO') && ($orden->estan_los_moldes=='NO'))// CUANDO EXISTEN Y ESTAN HECHOS LOS MOLDES
                            {
                                $moldeNuevo='No Corresponde';
                            }                              
                            $molde=$this->moldes_model->getMoldesPorId($orden->id_molde);
                            $materialidad_1=$this->materiales_model->getMaterialesPorNombre($fotomecanica->materialidad_1);
                            $materialidad_2=$this->materiales_model->getMaterialesPorNombre($fotomecanica->materialidad_2);
                            $materialidad_3=$this->materiales_model->getMaterialesPorNombre($fotomecanica->materialidad_3);     
                            $produccionFotomecanica=$this->orden_model->getOrdenesPorCotizacionEstado($id);
                            $hayparcial=$this->produccion_model->getParcialControlCartulina($id);
                    //echo $kilos1;
                            ?>
                                <li>Cliente : <a href="<?php echo base_url()?>clientes/edit/<?php echo $cli->id; ?>/0" title="Cliente" target="_blank"><b><?php echo $cliente?></b> </a></li>                     
                                <li>Orden de Producción en Cotización: <a href="<?php echo base_url()?>ordenes/pdf_orden/<?php echo $ordenDeCompra->id_cotizacion; ?>/<?php echo $ordenDeCompra->id; ?>" title="Orden de Producción en Cotización" target="_blank"><b>N° OT<?php echo $ordenDeCompra->id; ?></b></a></li>                     
                                <li>Descripción : <b><?php echo $datos->producto?></b></li>
                                <li>Fecha Orden de Compra : <strong><?php echo fecha($ordenDeCompra->fecha)?></strong></li>
                                <li>Fecha Orden de Producción : <strong><?php echo fecha($orden->fecha)?></strong></li>
                                <li>Condición del Producto : <strong><?php echo $datos->condicion_del_producto?></strong></li>
                                <?php if (!empty($molde->archivo)) {  ?>
                                    <li>N° Molde : <?php echo $molde->nombre?> <a href="<?php echo base_url().$this->config->item('direccion_pdf').$molde->archivo?>" target="_blank"><?php echo $orden->id_molde?></a> <strong>(<?php echo $moldeNuevo?>)</strong></li>
                                <?php } else {    ?>
                                    <li><strong>NO ESTÁ EL PDF DEL MOLDE</strong></li>
                                <?php }?>                         
                                <li>Lleva Troquel : <strong> <?php if ($fotomecanica->troquel_por_atras=='NO') echo "Por Delante";  else echo "Por Detras"; ?></strong></li>
                                <li>Cantidad Pliegos a Cortar : <strong><?php echo $hoja->placa_kilo; ?></strong></li>     
                                <li>Saldo pendiente : <strong><?php echo $hoja->placa_kilo - 0; ?></strong></li>     
                                <?php if(($hoja->placa_kilo>0) && ($ing->tamano_a_imprimir_1>0) && ($ing->tamano_a_imprimir_2>0)  && ($materialidad_1->gramaje>0)){ $tk=floor(($hoja->placa_kilo*$ing->tamano_a_imprimir_1*$ing->tamano_a_imprimir_2*$materialidad_1->gramaje)/10000000);?>
                                <li>Total Kilos de la orden : <strong><?php echo floor(($hoja->placa_kilo*$ing->tamano_a_imprimir_1*$ing->tamano_a_imprimir_2*$materialidad_1->gramaje)/10000000); ?> Kg</strong></li>    
                                <?php } else { ?>  
                                    <li>Total Kilos de la orden : <strong>0 </strong></li>    
                                <?php }?>  
                                <?php if(!empty($ing->archivo)){?> 
                                <li><strong>PDF trazado de Ingeniería </strong><a href='<?php echo base_url().$this->config->item('direccion_pdf').$ing->archivo ?>' title="Descargar" target="_blank"><i class="icon-search"></i></a></li>
                                <?php }else
                                {
                                    ?>
                                    <li><strong>NO ESTÁ EL PDF DE TRAZADO DE INGENIERÍA</strong></li>
                                    <?php
                                }?>
                                <?php if(!empty($fotomecanica->archivo)){?> 
                                <li><strong>PDF imagen </strong><a href='<?php echo base_url().$this->config->item('direccion_pdf').$fotomecanica->archivo ?>' title="Descargar" target="_blank"><i class="icon-search"></i></a></li>
                                <?php }else
                                {
                                    ?>
                                    <li><strong>NO ESTÁ EL PDF DE FOTOMECÁNICA</strong></li>
                                    <?php
                                }?>
                                   <?php  if(sizeof($fotomecanica2)==0){ ?>
                                    <li>Situación : <strong>Pendiente</strong></li>
                                    <?php } else {
                                         switch($control_cartulina->situacion)
                                         {
                                            case 'Liberada':
                                                ?>
                                                <li>Situación : <strong>Liberada el <?php echo fecha_con_hora($control_cartulina->fecha_liberada);?></strong></li>
                                                <?php
                                            break;
                                            case 'Activa':
                                                ?>
                                                <li>Situación : <strong>Activa el <?php echo fecha_con_hora($control_cartulina->fecha_activa);?></strong></li>
                                                <?php
                                            break;
                                         }
                                       }
                                  if ($fotomecanica2->fecha_liberada == '0000-00-00') {
                                    $fecha_liberada_foto = "No ha sido liberada de Fotomecanica";
                                  } else {
                                    $fecha_liberada_foto=fecha($fotomecanica2->fecha_liberada);
                                  } ?>
                                  <li>Fecha de liberacion Fotomecánica : <strong><?php echo $fecha_liberada_foto; ?></strong></li>
                                  <?php
                                  if($control_cartulina->estado=='1')
                                  {
                                      ?>
                                    <li>Fecha de liberacion Control cartunina : <strong><?php echo fecha($control_cartulina->fecha_liberada); ?></strong></li>
                                    <li><strong>Valores de Bobina</strong> : 
                                    <ul>
                                      <li>Gramaje: <?php echo $bobinas->gramaje?></li>
                                      <li>Kilos: <?php echo $bobinas->kilos?></li>
                                      <li>Ancho: <?php echo $bobinas->ancho?></li>
                                    </ul>
                                  </li>
                                      <?php
                                  }
                                  ?>
                                  
                                  <?php if ($control_cartulina->fecha_liberada!='0000-00-00 00:00:00') { ?>
                                    <li>Fecha de liberacion Control Cartulina : <strong><?php echo fecha($control_cartulina->fecha_liberada); ?></strong></li>
                                  <?php } ?>
                                  
                            </ul>
</div>

<div class="col-md-4" style="float: left;">
  <ul>
    <li>Placa :
                           <b><?php echo $tapa->materiales_tipo.'&nbsp;'.$tapa->gramaje; ?>  </b> </li> 
                     <li>Gramaje de la placa : <strong><?php echo $materialidad_1->gramaje?></strong></li>                           
                     <li><b><?php echo $fotomecanica->materialidad_datos_tecnicos; ?></b>:</li>
                    <?php
                    if($fotomecanica->materialidad_datos_tecnicos == 'Cartulina-cartulina') { ?>
                            <li> Onda : Tapa (Respaldo) </li>                      
                    <?php } else { ?>
                           <li>Onda : <b><?php echo $monda->materiales_tipo; ?>&nbsp;&nbsp;&nbsp;<?php echo $monda->gramaje; ?></b></li>
                    <?php } ?>   
                    <?php
                    if($fotomecanica->materialidad_datos_tecnicos == 'Cartulina-cartulina') { ?>
                            <li><?php echo $monda->materiales_tipo.'&nbsp; '.$monda->gramaje; ?></li>   
                            <li><?php echo $hoja->onda_kilo.'&nbsp;'.$monda->gramaje; ?></li>                               
                    <?php } else { ?>
                            <li>Liner: <b><?php echo $mliner->materiales_tipo.'&nbsp; '.$mliner->gramaje; ?></b></li>   
                    <?php } ?>          
                     <li>Tamaño Pliego : <strong><?php echo $ing->tamano_a_imprimir_1; ?> X <?php echo $ing->tamano_a_imprimir_2;  ?> Cms</strong></li>
                     <li>Unidad Pliego: <strong><?php echo $ing->unidades_por_pliego; ?></strong></li>
                     <li>Repetición: <strong><?php  if($datos->condicion_del_producto=='Nuevo') echo "NO"; else echo "SI"; ?></strong></li>
                     <li>Traxado : <strong><?php  if ($ing->archivo=="") { echo 'NO'; } else { echo 'SI'; }  ?></strong></li>
                     <li>Cromalin : <strong><?php echo $datos->impresion_hacer_cromalin; ?></strong></li>                     
                     <li>Montaje : <strong><?php echo $datos->montaje_pieza_especial; ?></strong></li>                     
                     <li>Colores : <strong><?php  echo $fotomecanica->colores; ?></strong></li>
                     <?php echo herramientas_funciones::MostrarBarniz($ing);  ?>                     
                     <li>Total merma : <strong><?php  echo $hoja->total_merma; ?></strong></li>
                </ul> 
</div>
<div class="col-md-4" style="float: left;">
  <ul>
                     <li>Cantidad a imprimir : <strong><?php echo $hoja->placa_kilo; ?></strong></li>                     
                     <li>Gato : <strong><?php if($fotomecanica->troquel_por_atras=='NO'){echo 'Derecho';}else{echo 'Izquierdo';} ?></strong></li>        
                     <li>Distancia Cuchillo a Cuchillo : <strong><?php echo $ing->tamano_cuchillo_1; ?> X <?php echo $ing->tamano_cuchillo_2;  ?> Cms</strong></li>        
                     <li>Metros de Cuchillo : <strong><?php echo $ing->metros_de_cuchillo;  ?> Cms</strong></li>        
                     <li>Descripción de la placa : <strong><?php echo $materialidad_1->nombre?></strong></li>

                     <li>CCAC1 : <strong><?php echo number_format((($ing->tamano_a_imprimir_1-$ing->tamano_cuchillo_1)*10),1,',','.');?> Mms</strong></li>
                     <li>CCAC2 : <strong><?php echo number_format((($ing->tamano_a_imprimir_2-$ing->tamano_cuchillo_2)*10),1,',','.') ?> Mms</strong></li>
                     <li>Ancho mínimo cartulina : <strong><?php echo number_format($ing->tamano_cuchillo_1+2,1,',','.');?> (<?php echo ($ing->tamano_cuchillo_1+2)*10?> milímetros)</strong></li>                   
                </ul>
</div>
</div>
<!--/información encabezado--> 
<!--formulario-->
<div class="container">
  <div style="height: 100px">&nbsp;</div>
<div class="control-group">
    <label class="control-label" for="usuario">Comentarios para una eventual repetición</label>
    <div class="controls">
            <input type="text" name="descripcion_del_trabajo_referencia" value="<?php echo set_value_input($control_cartulina,'descripcion_del_trabajo',$control_cartulina->descripcion_del_trabajo);?>" />
       </div>
  </div> 
   <div class="control-group">
    <label class="control-label" for="usuario">Descripción de la Placa Cotizada</label>
    <div class="controls">
      <input type="text" name="descripcion_de_la_tapa_referencia" value="<?php echo $materialidad_1->nombre;?>" readonly="true" />
       </div>
  </div>
   <?php $materialidad_1=$this->materiales_model->getMaterialesPorNombre($fotomecanica->materialidad_1);?>
    <div class="control-group">
    <label class="control-label" for="usuario">Gramaje Cotizado</label>
    <div class="controls">
      <input type="text" name="gramaje" id="gramaje" value="<?php echo $gramaje_cotizado = $materialidad_1->gramaje?>" readonly="true" />
            <input type="hidden" name="aplica_gramaje" value="<?php echo $control_cartulina->aplica_gramaje?>" /> 
        </div>
  </div>
  <input type="hidden" name="datos_tecnicos" value="<?php echo $fotomecanica->materialidad_datos_tecnicos;?>" readonly="true" />
  <?php
  $kilosCartulina=$this->produccion_model->MermasParaProduccion($id,$materialidad_1->gramaje,$ing->tamano_a_imprimir_1);
  $kilosCartulina = str_replace('.', '',number_format($kilosCartulina,0,'','.'));
  ?>
    
   <div class="control-group">
    <label class="control-label" for="usuario">Ancho de Bobina Cotizado (<?php echo $ing->tamano_a_imprimir_1;?> Cms)</label>
    <div class="controls">
      <input type="text" name="ancho_de_bobina" id="ancho_de_bobina" value="<?php echo $ancho_cotizado = ($ing->tamano_a_imprimir_1*10);?>" readonly="true" /> <strong>(Mms)</strong>
        </div>
  </div>
  
    <div class="control-group">
      <label class="control-label" for="usuario">Largo a cortar</label>
      <div class="controls">
        <input type="text" name="largo_a_cortar" id="largo_a_cortar" value="<?php echo $ing->tamano_a_imprimir_2; ?>" readonly="true" /> <strong>(Cms)</strong>
      </div>
    </div>
  
  
    <div class="control-group">
      <label class="control-label" for="usuario">Total Kilos de la Cartulina Cotizadas</label>
      <div class="controls">
        <input type="text"  id="total_kilos" name="total_kilos" onkeypress="return soloNumeros(event)" value="<?php echo $total_kilos = floor(($hoja->placa_kilo*$ing->tamano_a_imprimir_1*$ing->tamano_a_imprimir_2*$materialidad_1->gramaje)/10000000); ?>" placeholder="0" readonly="true" /> 
        
          <?php
          if(sizeof($hayparcial->sum) == 0)
          { 
          }else
          {
            $pendiente = $control_cartulina->total_kilos - $hayparcial->sum;
            if($control_cartulina->estado ==3 ){
          ?>
            <!--<input type="text" name="total_kilosParciales" value="<?php echo 'Pendientes : '.$pendiente;?>" readonly="true" />-->
          <?php
            }
          }
          ?>
        <span style="display: inline-block;"><strong>Total Metros: </strong><?php echo $total_metros_cotizados = round(($total_kilos/($ancho_cotizado*$gramaje_cotizado)*1000000)); ?></span>
        <input type="hidden" value="<?php echo $total_metros_cotizados; ?>" id="total_metros_cotizados" name="total_metros_cotizados" />
      </div>
    </div>
    
    <div class="control-group">
      <label class="control-label" for="usuario">Seleccionar Menu</label>
      <div class="controls">
        <select name="menu_bobina_pliego" id="menu_bobina_pliego" <?php echo set_value_select($control_cartulina,'menu_bobina_pliego',$control_cartulina->menu_bobina_pliego,$control_cartulina->menu_bobina_pliego)?> onchange="control_cartulina_menus(this.value);">
          <option value="0">Seleccione</option>
          <option value="1" <?php if($control_cartulina->menu_bobina_pliego=="Menu Bobina"){echo "selected";} ?>>Menu Bobina</option>
          <option value="2" <?php if($control_cartulina->menu_bobina_pliego=="Menu Pliego"){echo "selected";} ?>>Menu Pliego</option>
        </select>
      </div>
    </div>

<!--menú bobina-->
<div id="menu_bobina" style="display: none;">
  <!--INICIO - EXISTENCIA-->
    <h3>Existencia</h3>
    <div class="control-group">
      <label class="control-label" for="usuario">Estado Materia prima</label>
      <div class="controls">
          <select name="existencia" id="existencia" <?php echo set_value_select($control_cartulina,'existencia',$control_cartulina->existencia,$control_cartulina->existencia)?> onchange="control_cartulina_menus_existencias(this.value);">
            <option value="0">Seleccione...</option>
            <option value="1" <?php if($control_cartulina->existencia=="Hay stock total"){echo "selected";} ?> >Hay stock total</option>
            <option value="2" <?php echo set_value_select($control_cartulina,'existencia',$control_cartulina->existencia  ,'Comprar Total');?>>Comprar total</option>
            <option value="3"  <?php echo set_value_select($control_cartulina,'existencia',$control_cartulina->existencia  ,'Stock Parcial');?>>Hay stock parcial</option>
            <option value="4" <?php echo set_value_select($control_cartulina,'existencia',$control_cartulina->existencia  ,'Comprar Parcial');?>>Comprar Parcial</option>
        </select>
      </div>

      <div id="hay_stock_total" style="display: none;">hay_stock_total</div>
      <div id="comprar_total" style="display: none;">
          <div class="control-group" id="comprar_total_opciones1">
        <label class="control-label" for="usuario">Proveedor</label>
        <div class="controls">
          <select name="Proveedor_CompraTotal"  class="chosen-select" onchange="llenar_datos_proveedor(this.value);">
              <option value="">Seleccione</option>

              <?php
              if ($control_cartulina->existencia=="Comprar Total") { ?>
                <option value="<?php echo $control_cartulina->Proveedor_CompraTotal ?>"><?php echo $control_cartulina->Proveedor_CompraTotal?></option>
              <?php }
              $proves=$this->proveedores_model->getProveedores();

                  foreach($proves as $prove)
                  {
                  ?>
                    <option value="<?php echo $prove->id?>" <?php if($control_cartulina->Proveedor_CompraTotal==$prove->id){echo 'selected="true"';}?>><?php echo $prove->nombre?></option>
                  <?php
                  }
              ?>
          </select>
        </div>
      </div>
      </div>
      <div id="stock_parcial" style="display: none;">stock_parcial</div>
      <div id="comprar_parcial" style="display: none;">comprar_parcial</div>
    </div>
    <!--bobinas-->
        <div id="bobinas" style="display: none;">

          <!--bobina 1-->
          <h3>Primera Bobina</h3>
              <div class="control-group">
      <label class="control-label" for="usuario">Tapas (Placas) Seleccionado <br> 1ra Bobina</label>
      <div class="controls">
        <select name="descripcion_de_la_tapa" id="select_bobina1" class="chosen-select" onchange="carga_ajax_obtenerGramaje(this.value,'gramaje_ajax');">
            <option value="0">Seleccione......</option>
            <option value="no_hay">No hay</option>
            <?php
            $tapas=$this->materiales_model->getMaterialesSelectCartulina();
            foreach($tapas as $tapa1)
            {
              if ($control_cartulina->descripcion_de_la_tapa=='')  {
                ?>
                  <option value="<?php echo $tapa1->codigo?>" <?php if($tapa1->nombre==$fotomecanica->materialidad_1){echo 'selected="selected"';}?>><?php echo $tapa1->gramaje?> ( <?php echo $tapa1->materiales_tipo?> - $<?php echo $tapa1->precio?> ) (<?php echo $tapa1->reverso?>)</option>
                <?php
                } else  { ?>
                  <option value="<?php echo $tapa1->codigo?>" <?php if($tapa1->codigo==$control_cartulina->descripcion_de_la_tapa){echo 'selected="selected"';}?>><?php echo $tapa1->gramaje?> ( <?php echo $tapa1->materiales_tipo?> - $<?php echo $tapa1->precio?> ) (<?php echo $tapa1->reverso?>)</option>
                 <?php }
             }
            ?>
        </select>
      </div>
    </div>
     <div class="control-group" hidden>
      <label class="control-label" for="usuario">Gramaje seleccionado 1ra Bobina</label>
      <div id="gramaje_ajax" class="controls">
        <input type="text" name="gramaje_seleccionado" id="gramaje_seleccionado" value="<?php echo $gramaje_cotizado = $materialidad_1->gramaje?>" placeholder="Gramaje seleccionado" onblur="validacion_gramaje_control_cartulina();" onchange="ControlGranajeSeleccionado(<?php echo $id?>);validacion_gramaje_control_cartulina();"/>
      </div>
    </div>

    <div class="control-group">
      <label class="control-label" for="usuario">Ancho seleccionado de bobina (<?php echo ($ing->tamano_a_imprimir_1);?> Cms) 1ra Bobina</label>
      <div class="controls">
        <input type="text" name="ancho_seleccionado_de_bobina" id="ancho_seleccionado_de_bobina"  value="<?php if($control_cartulina->ancho_seleccionado_de_bobina >0){echo ($control_cartulina->ancho_seleccionado_de_bobina);}else {echo ($ing->tamano_a_imprimir_1*10);}?>" placeholder="Ancho seleccionado de bobina" onblur="validar_ancho_bobina_seleccionada('1');" onkeypress="return soloNumeros(event)"/> <strong>(Mms)</strong><span id="metros_ingresados_bobina1"></span>
      </div>
    </div>


    <div class="control-group">
      <label class="control-label" for="usuario">Kilos de la Bobina Seleccionada <br> 1ra Bobina</label>
      <div class="controls">
        <input type="text" name="kilos_bobina_seleccionada"  max="4000" class="limitvalue" onblur="/*validacion_kilos_bobina_seleccionada_control_cartulina();*/control_cartulina_reiniciar_calculos_bobinas_cortes('<?php echo $tapa->gramaje?>');" id="kilos_bobina_seleccionada"  value="<?php if($control_cartulina->kilos_bobina_seleccionada >0 && ($control_cartulina->situacion=='Guardar' || $control_cartulina->situacion=='Liberada')){echo ($control_cartulina->kilos_bobina_seleccionada);}else{echo 0;}?>" onkeypress="return soloNumeros(event)" placeholder="0"/> <span id="kilos_bobina_seleccionada_div" style="background-color: red;color:#fff;font-weight: bold; font-size: 11px; display: none;">ss</span>
      </div> 
    </div> 
<div class="control-group">
      <label class="control-label" for="usuario"><strong>Hay que bobinar</strong></label>
      <div class="controls">
        <select id="hay_que_bobinar" name="hay_que_bobinar">
          <option value="" <?php if (sizeof($control_cartulina)==0){echo "selected";}?>>Seleccione</option>                                            
          <option value="NO" <?php echo set_value_select($control_cartulina,'hay_que_bobinar',$control_cartulina->hay_que_bobinar,'NO');?>>NO</option>
          <option value="SI" <?php echo set_value_select($control_cartulina,'hay_que_bobinar',$control_cartulina->hay_que_bobinar,'SI');?>>SI</option>
        </select>
      </div>
          </div>
          <!--/bobina 1-->
          <!--bobina 2-->
          <h3>Segunda Bobina</h3>
          <div class="control-group">
            <label class="control-label" for="usuario">Tapas (Placas) Seleccionado <br> 2da Bobina</label>
            <div class="controls">
            <select name="descripcion_de_la_tapa2" id="select_bobina2" class="chosen-select" onchange="carga_ajax_obtenerGramaje2(this.value,'gramaje_ajax2');">
              <option value="0">Seleccione......</option>
              <option value="no_hay">No hay</option>
              <?php
              $tapas=$this->materiales_model->getMaterialesSelectCartulina();
              foreach($tapas as $tapa)
              {
                if ($control_cartulina->descripcion_de_la_tapa=='')  {
                  ?>
                    <option value="<?php echo $tapa->codigo?>" <?php if($tapa->nombre==$fotomecanica->materialidad_1){echo 'selected="selected"';}?>><?php echo $tapa->gramaje?> ( <?php echo $tapa->materiales_tipo?> - $<?php echo $tapa->precio?> ) (<?php echo $tapa->reverso?>)</option>
                  <?php
                  } else  { 
                      if ($control_cartulina->descripcion_de_la_tapa2=='') { ?>
                        <option value="<?php echo $tapa->codigo?>" <?php if($tapa->codigo==$control_cartulina->descripcion_de_la_tapa ){echo 'selected="selected"';}?>><?php echo $tapa->gramaje?> ( <?php echo $tapa->materiales_tipo?> - $<?php echo $tapa->precio?> ) (<?php echo $tapa->reverso?>)</option>
                     <?php } else { ?>
                        <option value="<?php echo $tapa->codigo?>" <?php if($tapa->codigo==$control_cartulina->descripcion_de_la_tapa2){echo 'selected="selected"';}?>><?php echo $tapa->gramaje?> ( <?php echo $tapa->materiales_tipo?> - $<?php echo $tapa->precio?> ) (<?php echo $tapa->reverso?>)</option>
                     <?php }
                    ?>
                    
                   <?php }
               }
              ?>
          </select>
            </div>
      </div>

      <div class="control-group" hidden>
        <label class="control-label" for="usuario">Gramaje seleccionado 2da Bobina</label>
        <div id="gramaje_ajax2" class="controls">
          <input type="text" name="gramaje_seleccionado2" id="gramaje_seleccionado2" value="<?php if ($control_cartulina->gramaje_seleccionado2>0) { echo $control_cartulina->gramaje_seleccionado2; } else { echo $gramaje_cotizado = $materialidad_1->gramaje;} ?>" placeholder="Gramaje seleccionado" onblur="validacion_gramaje_control_cartulina();" onchange="ControlGranajeSeleccionado2(<?php echo $id?>);validacion_gramaje_control_cartulina();"/>
        </div>
      </div>

      <div class="control-group">
        <label class="control-label" for="usuario">Ancho seleccionado de bobina (<?php echo ($ing->tamano_a_imprimir_1);?> Cms) 2da Bobina</label>
        <div class="controls">
          <input type="text" name="ancho_seleccionado_de_bobina2" id="ancho_seleccionado_de_bobina2"  value="<?php if ($control_cartulina->ancho_seleccionado_de_bobina2>0) { echo $control_cartulina->ancho_seleccionado_de_bobina2;}else{echo 0;}//if($bobinas->ancho >0){echo ($bobinas->ancho);}else {echo ($ing->tamano_a_imprimir_1*10);}?>" placeholder="Ancho seleccionado de bobina" onblur="validar_ancho_bobina_seleccionada('2');" onchange="/*validacion_ancho_bobina_seleccionada_control_cartulina2();*/ControlGranajeSeleccionado(<?php echo $id?>);limpiar_cortes_control_cartulina();"/> <strong>(Mms)</strong><span id="metros_ingresados_bobina2"></span>
        </div>
      </div> 

      <div class="control-group">
        <label class="control-label" for="usuario">Kilos de la Bobina Seleccionada <br> 2da Bobina</label>
        <div class="controls">
            <input type="text" name="kilos_bobina_seleccionada2"   max="4000" class="limitvalue" onblur="/*validacion_kilos_bobina_seleccionada_control_cartulina();*/reiniciar_calculos_bobinas_cortes();" id="kilos_bobina_seleccionada2"  value="<?php if ($control_cartulina->kilos_bobina_seleccionada2>0) { echo $control_cartulina->kilos_bobina_seleccionada2;}else{echo 0;}//if($control_cartulina->kilos_bobina_seleccionada >0){echo ($bobinas->kilos);}?>" placeholder="0"/> <strong>(Kg)</strong><span id="resto2_metros"></span><span class="" id="resto2"></span>
        </div>
      </div> 
      <div class="control-group">
      <label class="control-label" for="usuario"><strong>Hay que bobinar</strong></label>
      <div class="controls">
        <select id="hay_que_bobinar2" name="hay_que_bobinar2">
          <option value="" <?php if (sizeof($control_cartulina)==0){echo "selected";}?>>Seleccione</option>                                            
          <option value="NO" <?php echo set_value_select($control_cartulina,'hay_que_bobinar',$control_cartulina->hay_que_bobinar,'NO');?>>NO</option>
          <option value="SI" <?php echo set_value_select($control_cartulina,'hay_que_bobinar',$control_cartulina->hay_que_bobinar,'SI');?>>SI</option>
        </select>
      </div>
          </div>
          <!--/bobina 2-->
          <!--bobina 3-->
          <h3>Tercera Bobina</h3>
          <div class="control-group">
            <label class="control-label" for="usuario">Tapas (Placas) Seleccionado <br> 3da Bobina</label>
            <div class="controls">
            <select name="descripcion_de_la_tapa3" id="select_bobina3" class="chosen-select" onchange="carga_ajax_obtenerGramaje3(this.value,'gramaje_ajax3');">
              <option value="0">Seleccione......</option>
              <option value="no_hay">No hay</option>
              <?php
              $tapas=$this->materiales_model->getMaterialesSelectCartulina();
              foreach($tapas as $tapa)
              {
                if ($control_cartulina->descripcion_de_la_tapa=='')  {
                  ?>
                    <option value="<?php echo $tapa->codigo?>" <?php if($tapa->nombre==$fotomecanica->materialidad_1){echo 'selected="selected"';}?>><?php echo $tapa->gramaje?> ( <?php echo $tapa->materiales_tipo?> - $<?php echo $tapa->precio?> ) (<?php echo $tapa->reverso?>)</option>
                  <?php
                  } else  {

                      if ($control_cartulina->descripcion_de_la_tapa3=='') { ?>
                        <option value="<?php echo $tapa->codigo?>" <?php if($tapa->codigo==$control_cartulina->descripcion_de_la_tapa){echo 'selected="selected"';}?>><?php echo $tapa->gramaje?> ( <?php echo $tapa->materiales_tipo?> - $<?php echo $tapa->precio?> ) (<?php echo $tapa->reverso?>)</option>
                     <?php } else { ?>
                        <option value="<?php echo $tapa->codigo?>" <?php if($tapa->codigo==$control_cartulina->descripcion_de_la_tapa3){echo 'selected="selected"';}?>><?php echo $tapa->gramaje?> ( <?php echo $tapa->materiales_tipo?> - $<?php echo $tapa->precio?> ) (<?php echo $tapa->reverso?>)</option>
                     <?php }
                  }
               }
              ?>
          </select>
            </div>
      </div>

      <div class="control-group" hidden>
        <label class="control-label" for="usuario">Gramaje seleccionado 3ra Bobina</label>
        <div id="gramaje_ajax3" class="controls">
          <input type="text" name="gramaje_seleccionado3" id="gramaje_seleccionado3" value="<?php if ($control_cartulina->gramaje_seleccionado3>0) { echo $control_cartulina->gramaje_seleccionado3; }else{ echo $gramaje_cotizado = $materialidad_1->gramaje; }?>" placeholder="Gramaje seleccionado" onblur="validacion_gramaje_control_cartulina();" onchange="ControlGranajeSeleccionado3(<?php echo $id?>);validacion_gramaje_control_cartulina();"/>
        </div>
      </div>

      <div class="control-group">
        <label class="control-label" for="usuario">Ancho seleccionado de bobina (<?php echo ($ing->tamano_a_imprimir_1);?> Cms) 3da Bobina</label>
        <div class="controls">
          <input type="text" name="ancho_seleccionado_de_bobina3" id="ancho_seleccionado_de_bobina3"  value="<?php if ($control_cartulina->ancho_seleccionado_de_bobina3>0) { echo $control_cartulina->ancho_seleccionado_de_bobina3; }else {echo 0;}//if($bobinas->ancho >0){echo ($bobinas->ancho);}else {echo ($ing->tamano_a_imprimir_1*10);}?>" placeholder="Ancho seleccionado de bobina" onblur="validar_ancho_bobina_seleccionada('3');" onchange="/*validacion_ancho_bobina_seleccionada_control_cartulina3();*/ControlGranajeSeleccionado(<?php echo $id?>);limpiar_cortes_control_cartulina();"/> <strong>(Mms)</strong><span id="metros_ingresados_bobina3"></span>
        </div>
      </div> 

      <div class="control-group">
        <label class="control-label" for="usuario">Kilos de la Bobina Seleccionada <br> 3da Bobina</label>
        <div class="controls">
            <input type="text" name="kilos_bobina_seleccionada3"  max="4000" class="limitvalue" onblur="/*validacion_kilos_bobina_seleccionada_control_cartulina();*/reiniciar_calculos_bobinas_cortes();" id="kilos_bobina_seleccionada3"  value="<?php if ($control_cartulina->kilos_bobina_seleccionada3>0) { echo $control_cartulina->kilos_bobina_seleccionada3; } else { echo 0; }//if($control_cartulina->kilos_bobina_seleccionada >0){echo ($bobinas->kilos);}?>" placeholder="0"/> <strong>(Kg)</strong><span id="resto3_metros"></span><span class="" id="resto3"></span>
        </div>
      </div> 
      <div class="control-group">
      <label class="control-label" for="usuario"><strong>Hay que bobinar</strong></label>
      <div class="controls">
        <select id="hay_que_bobinar3" name="hay_que_bobinar3">
          <option value="" <?php if (sizeof($control_cartulina)==0){echo "selected";}?>>Seleccione</option>                                            
          <option value="NO" <?php echo set_value_select($control_cartulina,'hay_que_bobinar',$control_cartulina->hay_que_bobinar,'NO');?>>NO</option>
          <option value="SI" <?php echo set_value_select($control_cartulina,'hay_que_bobinar',$control_cartulina->hay_que_bobinar,'SI');?>>SI</option>
        </select>
      </div>
          </div>
          <!--/bobina 3-->

        </div>
    <!--/bobinas-->
    <h3>RESUMEN</h3>

   
    

   <div class="control-group">
        <label class="control-label" for="usuario">Total Metros</label>
        <div class="controls">
                        <input type="text" readonly="true" id="total_metros" name="total_metros" onkeypress="return soloNumeros(event)" value="9756.76"/> 
        </div>
  </div>   
  <div class="control-group">
      <label class="control-label" for="usuario">Unidades por pliego</label>
      <div class="controls">
        <input type="text" id="unidades_por_pliego" name="unidades_por_pliego" placeholder="Unidades por pliego" id="unidades_por_pliego" onkeypress="return soloNumeros(event)" value="<?php echo $ing->unidades_por_pliego?>" readonly="true" />
      </div>
    </div>
    
    <div class="control-group">
      <label class="control-label" for="usuario">Número de Bobina <strong style="color: red;">(*)</strong></label>
      <div class="controls">
        <input type="text" id="numero_de_bobina" name="numero_de_bobina" placeholder="Número de Bobina" value="<?php if($control_cartulina->numero_de_bobina == null){echo 1;}else{echo set_value_input($control_cartulina,'numero_de_bobina',$control_cartulina->numero_de_bobina);}?>" />
      </div>
    </div>
    
    <div class="control-group" hidden="true" id="numero_bobina2_div">
      <label class="control-label" for="usuario">Número de Bobina 2 <strong style="color: red;">(*)</strong></label>
      <div class="controls">
        <input type="text" id="numero_de_bobina2" name="numero_de_bobina2" placeholder="Número de Bobina2" value="<?php if($control_cartulina->numero_bobina2 == null){echo 2;}else{ echo set_value_input($control_cartulina,'numero_de_bobina2',$control_cartulina->numero_de_bobina2);}?>" />
      </div>
    </div>

    <div class="control-group" hidden="true" id="numero_bobina3_div">
      <label class="control-label" for="usuario">Número de Bobina 3 <strong style="color: red;">(*)</strong></label>
      <div class="controls">
        <input type="text" id="numero_de_bobina3" name="numero_de_bobina3" placeholder="Número de Bobina3" value="<?php if($control_cartulina->numero_bobina3 == null){echo 3;}else{ echo set_value_input($control_cartulina,'numero_de_bobina3',$control_cartulina->numero_de_bobina3);}?>" />
      </div>
    </div>
    
    <div class="control-group">
      <label class="control-label" for="usuario">Total de Bobinas <strong style="color: red;">(*)</strong></label>
      <div class="controls">
        <input type="text" id="total_de_bobinas" name="total_de_bobinas" placeholder="Total de Bobinas" value="<?php echo set_value_input($control_cartulina,'total_de_bobinas',$control_cartulina->total_de_bobinas);?>" />
      </div>
    </div>
    
    <div class="control-group">
      <label class="control-label" for="quien_sabe_ubicacion_de_la_bobina">Quién sabe ubicación de la Bobina <strong style="color: red;">(*)</strong></label>
      <div class="controls">
        <select id="quien_sabe_ubicacion_de_la_bobina" name="quien_sabe_ubicacion_de_la_bobina"  class="chosen-select">
          <option value="0">Seleccione.....</option>
          <?php
          foreach($usuarios as $usuario)
          {
            ?>
            <option value="2" <?php echo "selected"; ?>><?php echo $usuario->nombre?></option>
            <option value="<?php echo $usuario->id?>" <?php echo set_value_select($control_cartulina,'quien_sabe_ubicacion_de_la_bobina',$control_cartulina->quien_sabe_ubicacion_de_la_bobina,$usuario->id)?>><?php echo $usuario->nombre?></option>
            <?php
          }
          ?>
        </select>
      </div>
    </div>

    <h3>En caso de no haber disponibilidad en fabrica</h3>
    <div class="control-group">
      <label class="control-label" for="usuario">Hay en stock en Plaza</label>
      <div class="controls">
        <select name="hay_en_stock" onchange="hayEnStock(this.value); mostraria(this.value);">
          <option value="">--Seleccione--</option>            
          <option value="NO" <?php echo set_value_select($control_cartulina,'hay_en_stock',$control_cartulina->hay_en_stock,'NO')?>>NO</option>
          <option value="SI" <?php echo set_value_select($control_cartulina,'hay_en_stock',$control_cartulina->hay_en_stock,'SI')?>>SI</option>
        </select>
      </div>
    </div>
    
  
    <div class="control-group">
      <label class="control-label" for="usuario">Cantidad Total o parcial <strong style="color: red;">(*)</strong></label>
      <div class="controls">
        <select name="cantidad_total_o_parcial" onchange="Parcial(this.value)" >
          <option value="Total"   <?php if($control_cartulina->cantidad_total_o_parcial=='Total'){echo 'selected="true"';}  ?>>Total</option>
          <option value="Parcial" <?php if($control_cartulina->cantidad_total_o_parcial=='Parcial'){echo 'selected="true"';}?>>Parcial</option>
        </select>
      </div>
    </div>
     <div class="control-group">
      <label class="control-label" for="usuario">Proveedor</label>
      <div class="controls">
        <select name="proveedor" onchange="llenar_datos_proveedor(this.value);">
          <option value="">-- Seleccione --</option>
          <?php
          $proves=$this->proveedores_model->getProveedores();
          foreach($proves as $prove)
          {
              ?>
              <option value="<?php echo $prove->id?>" <?php if($control_cartulina->proveedor==$prove->id){echo 'selected="true"';}?>><?php echo $prove->nombre?></option>
              <?php
          }
          ?>
        </select>
      </div>
    </div>  
        <div class="control-group">
    <label class="control-label" for="usuario">Fecha estimada de recepción en fabrica<strong style="color: red;">(*)</strong></label>
    <div class="controls">
      <input type="text" name="fecha_estimada_recepcion" class="datepicker" placeholder="Introduzca Fecha" value="<?php if(sizeof($control_cartulina)>0){  $invert = explode("-",$control_cartulina->fecha_estimada_recepcion);
                    $fecha_estimada_recepcion = $invert[2]."-".$invert[1]."-".$invert[0]; echo $fecha_estimada_recepcion;}?>">
    </div>
        </div>    
    <div class="control-group">
    <label class="control-label" for="usuario">Quien Compra</label>
    <div class="controls">
              <select name="quien_compra"  class="chosen-select">
                <option value="0">Seleccione.....</option>
                <?php
                foreach($usuarios as $usuario)
                {
                    ?>
                    <option value="<?php echo $usuario->id?>" <?php echo set_value_select($control_cartulina,'quien_compra',$control_cartulina->quien_compra,$usuario->id)?>><?php echo $usuario->nombre?></option>
                    <?php
                }
                ?>
            </select>
                </div>
  </div>
  <div class="control-group" id="totaloparcial" style="<?php if($control_cartulina->cantidad_total_o_parcial=='Parcial'){echo 'display: block';}else{ echo 'display: none';}?>;">
    <label class="control-label" for="usuario">Total de Kilos Seleccionados</label>
      <div class="controls">
                            <input type="text" name="total_kilos2"  value="<?php echo $control_cartulina->total_kilos2 ?>"/>
        <?php
        //Pendientes
        if(sizeof($hayparcial->sum) == 0)
        { 
          if($control_cartulina->total_kilos >0)
          {
          ?>
          <input type="text" name="total_kilos_a_bobinar" value="<?php echo $control_cartulina->total_kilos; ?>" readonly="true" />
          <?php
          }
        }else
        {
          $pendiente = $control_cartulina->total_kilos - $hayparcial->sum;
        ?>
          <input type="text" name="total_kilosParciales" value="<?php echo 'Pendientes : '.$pendiente;?>" readonly="true" />
        <?php
        }
        //Pendientes 
        ?>
        
       </div>
  </div>
  <div class="control-group" id="ocultillo">
    <label class="control-label" for="usuario">Preguntar a</label>
    <div class="controls">
              <select name="preguntar_stock_a"  class="chosen-select">
                <option value="0">Seleccione.....</option>
                <?php
                foreach($usuarios as $usuario)
                {
                    ?>
                    <option value="<?php echo $usuario->id?>" <?php echo set_value_select($control_cartulina,'preguntar_stock_a',$control_cartulina->preguntar_stock_a,$usuario->id)?>><?php echo $usuario->nombre?></option>
                    <?php
                }
                ?>
            </select>
                </div>
  </div>
    <div class="control-group">
    <label class="control-label" for="usuario">Recepcionado</label>
    <div class="controls">
                    <select name="recepcionados" onchange="recepcionado(this.value);">
                <option value="">Seleccione.....</option>
                <option value="SI" <?php echo set_value_select($control_cartulina,'recepcionados',$control_cartulina->recepcionados,"SI")?>>Si</option>
                <option value="NO" <?php echo set_value_select($control_cartulina,'recepcionados',$control_cartulina->recepcionados,"NO")?>>No</option>
            </select>
                </div>
  </div>

  <div class="control-group">
    <div class="form-actions">
        <input type="button" value="Guardar" class="btn <?php if($control_cartulina->estado==0){echo 'btn-warning';}?>" onclick="guardarFormularioAdd('0');forma.submit()"/>
      
        <input type="button" value="Liberar" class="btn <?php if($control_cartulina->estado==1){echo 'btn-warning';}?> boton_liberar_normal liberar_boton_class" id='btnliberar'/>
        <input type="button" value="Reversar" class="btn <?php if($control_cartulina->estado==4){echo 'btn-warning';}?>" onclick="guardarFormularioAdd('4');" onclick="reversar(<?php echo $dato->id ?>)" />
    </div>
  </div>    


</div>
<!--/menú bobina-->
<!--menú pliegos-->
<div id="menu_pliegos" style="display: none;">
  menú pliegos
</div>
<!--/menú pliegos-->
</div>




 <input type="hidden" name="tipo" value="<?php echo $tipo?>" />
      <input type="hidden" name="pagina" value="<?php echo $pagina?>" />
      <input type="hidden" name="id" value="<?php echo $id?>" />
      <input type="hidden" name="orden_de_trabajo" value="<?php echo $orden_de_trabajo?>" />
      <input type="hidden" name="ancho_minimo_bobina" value="<?php echo ($ing->tamano_cuchillo_1+2)*10?>" />
      <input type="hidden" name="id_cliente" value="<?php if($tipo==1){echo $datos->id_cliente;}else{echo $datos->cliente;}?>" />
      <input type="hidden" name="indicador" />
      <input type="hidden" name="estado" />
      <input type="hidden" id="ccac1" name="ccac1" value="<?php echo (($ing->tamano_a_imprimir_1-$ing->tamano_cuchillo_1)*10); ?>" />
      <input type="hidden" id="can_imprimir" name="can_imprimir" value="<?php echo $hoja->placa_kilo; ?>" />
      <input type="hidden" id="tamano_a_imprimir_2" name="tamano_a_imprimir_2" value="<?php echo $ing->tamano_a_imprimir_2; ?>" />            
      <input type="hidden" id="can_minima_primer_corte" name="can_minima_primer_corte" value="<?php echo ($ing->tamano_a_imprimir_1*10); ?>" />
      <input type="hidden" id="tamano_cuchillo_2" name="tamano_cuchillo_2" value="<?php echo ($ing->tamano_cuchillo_2); ?>" />

      <input type="hidden" id="input_restante" name="input_restante" value="<?php if ($control_cartulina->input_restante>0){ echo $control_cartulina->input_restante; } else {echo '';} ?>">
      
      <input type="hidden" id="total_kilos_restantes"  name="total_kilos_restantes"  value="<?php if ($control_cartulina->total_kilos_restantes>0){ echo $control_cartulina->total_kilos_restantes; } else {echo '';} ?>">
      <input type="hidden"   id="total_kilos_ingresados" name="total_kilos_ingresados" value="<?php if ($control_cartulina->total_kilos_ingresados>0){ echo $control_cartulina->total_kilos_ingresados; } else {echo '';} ?>">

      <input type="hidden" id="total_metros_restantes" name="total_metros_restantes">
      <input type="hidden" id="total_metros_ingresados" name="total_metros_ingresados" value="<?php echo $control_cartulina->total_metros_ingresados; ?>">
<!--/formulario-->
<?php echo form_close();?>
</div>



