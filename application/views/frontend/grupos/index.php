<style type="text/css">
#mimodal{
  width: 100% !important;
}
</style>
<?php 
$ci = &get_instance();
$ci->load->model("cotizaciones_model");

if ( $this->session->flashdata('ControllerMessage') != '' ) : ?>

<div class="alert alert-success"><?php echo $this->session->flashdata('ControllerMessage'); ?></div>
<?php endif; ?>
<div class="page-header"><h3>Cotizaciones Grupales ( <?php echo sizeof($datos)?> en total)</h3></div>



<div>
	<!--<a class="btn btn-success pull-left" href="<?php// echo base_url()?>grupos/add">Agregar Grupo</a>-->
	<a class="btn btn-success pull-left" href="#">Agregar Grupo</a>
    <br /><br />

</div>

<table class="table table-bordered table-striped indice" id="">
	<thead>
		<tr>
		
			<th>Id</th>
			<th>Nombre de Grupo</th>
			<th>Cotizaciones Asociadas</th>
			<th>Detalle</th>
			<th>Fecha de Creacion</th>
                        <th>Acciones</th>
		</tr>
	</thead>
	<tbody>
    <?php
    function nombre_producto($id){
       // $nombre = $this->cotizaciones_model->getCotizacionPorId($id);
        return $nombre->producto;
    }
    
    foreach($datos as $dato)
    {
    ?>
			<td><?php echo $dato->id?></td>
                        <td><?php echo $dato->grupo?></td>
                        <td><?php echo "<ul>"?>
                        <?php if($dato->idc_01 != ""){ $nombre = $this->cotizaciones_model->getCotizacionPorId($dato->idc_01); echo "<li><a target='_blank' href='cotizaciones/search_cot/".$dato->idc_01."'>".$dato->idc_01.' - '.$nombre->producto; } ?><?php if($dato->idc_01 != ""){ $nombre = $this->cotizaciones_model->getCotizacionPorId($dato->idc_01); if($nombre->estan_los_moldes=="NO" && ($nombre->existe_trazado=="NO" || $nombre->existe_trazado=="")){echo "<a> - Por Definir</a>";}else if($nombre->estan_los_moldes=="NO" && $nombre->existe_trazado=="SI"){echo "<a>- Trazado:</a>".$nombre->trazado; $trazado = $this->trazados_model->getTrazadosPorId($nombre->trazado); echo "<a>.$trazado->estatus.</a>";}else if($nombre->estan_los_moldes=="MOLDE GENERICO"){echo "<a>- Molde:</a>".$nombre->numero_molde; $molde = $this->moldes_model->getMoldesPorId($nombre->numero_molde); echo "<a>.$molde->tipo.</a>";} } ?>
                        <?php if($dato->idc_02 != ""){ $nombre = $this->cotizaciones_model->getCotizacionPorId($dato->idc_02); echo "<li><a target='_blank' href='cotizaciones/search_cot/".$dato->idc_02."'>".$dato->idc_02.' - '.$nombre->producto; } ?><?php if($dato->idc_02 != ""){ $nombre = $this->cotizaciones_model->getCotizacionPorId($dato->idc_02); if($nombre->estan_los_moldes=="NO" && ($nombre->existe_trazado=="NO" || $nombre->existe_trazado=="")){echo "<a> - Por Definir</a>";}else if($nombre->estan_los_moldes=="NO" && $nombre->existe_trazado=="SI"){echo "<a>- Trazado:</a>".$nombre->trazado; $trazado = $this->trazados_model->getTrazadosPorId($nombre->trazado); echo "<a>.$trazado->estatus.</a>";}else if($nombre->estan_los_moldes=="MOLDE GENERICO"){echo "<a>- Molde:</a>".$nombre->numero_molde; $molde = $this->moldes_model->getMoldesPorId($nombre->numero_molde); echo "<a>.$molde->tipo.</a>";} } ?>
                        <?php if($dato->idc_03 != ""){ $nombre = $this->cotizaciones_model->getCotizacionPorId($dato->idc_03); echo "<li><a target='_blank' href='cotizaciones/search_cot/".$dato->idc_03."'>".$dato->idc_03.' - '.$nombre->producto; } ?><?php if($dato->idc_03 != ""){ $nombre = $this->cotizaciones_model->getCotizacionPorId($dato->idc_03); if($nombre->estan_los_moldes=="NO" && ($nombre->existe_trazado=="NO" || $nombre->existe_trazado=="")){echo "<a> - Por Definir</a>";}else if($nombre->estan_los_moldes=="NO" && $nombre->existe_trazado=="SI"){echo "<a>- Trazado:</a>".$nombre->trazado; $trazado = $this->trazados_model->getTrazadosPorId($nombre->trazado); echo "<a>.$trazado->estatus.</a>";}else if($nombre->estan_los_moldes=="MOLDE GENERICO"){echo "<a>- Molde:</a>".$nombre->numero_molde; $molde = $this->moldes_model->getMoldesPorId($nombre->numero_molde); echo "<a>.$molde->tipo.</a>";} } ?>
                        <?php if($dato->idc_03 != ""){ $nombre = $this->cotizaciones_model->getCotizacionPorId($dato->idc_03); echo "<li><a target='_blank' href='cotizaciones/search_cot/".$dato->idc_03."'>".$dato->idc_03.' - '.$nombre->producto; } ?><?php if($dato->idc_03 != ""){ $nombre = $this->cotizaciones_model->getCotizacionPorId($dato->idc_03); if($nombre->estan_los_moldes=="NO" && ($nombre->existe_trazado=="NO" || $nombre->existe_trazado=="")){echo "<a> - Por Definir</a>";}else if($nombre->estan_los_moldes=="NO" && $nombre->existe_trazado=="SI"){echo "<a>- Trazado:</a>".$nombre->trazado; $trazado = $this->trazados_model->getTrazadosPorId($nombre->trazado); echo "<a>.$trazado->estatus.</a>";}else if($nombre->estan_los_moldes=="MOLDE GENERICO"){echo "<a>- Molde:</a>".$nombre->numero_molde; $molde = $this->moldes_model->getMoldesPorId($nombre->numero_molde); echo "<a>.$molde->tipo.</a>";} } ?>
                        <?php if($dato->idc_04 != ""){ $nombre = $this->cotizaciones_model->getCotizacionPorId($dato->idc_04); echo "<li><a target='_blank' href='cotizaciones/search_cot/".$dato->idc_04."'>".$dato->idc_04.' - '.$nombre->producto; } ?><?php if($dato->idc_04 != ""){ $nombre = $this->cotizaciones_model->getCotizacionPorId($dato->idc_04); if($nombre->estan_los_moldes=="NO" && ($nombre->existe_trazado=="NO" || $nombre->existe_trazado=="")){echo "<a> - Por Definir</a>";}else if($nombre->estan_los_moldes=="NO" && $nombre->existe_trazado=="SI"){echo "<a>- Trazado:</a>".$nombre->trazado; $trazado = $this->trazados_model->getTrazadosPorId($nombre->trazado); echo "<a>.$trazado->estatus.</a>";}else if($nombre->estan_los_moldes=="MOLDE GENERICO"){echo "<a>- Molde:</a>".$nombre->numero_molde; $molde = $this->moldes_model->getMoldesPorId($nombre->numero_molde); echo "<a>.$molde->tipo.</a>";} } ?>
                        <?php if($dato->idc_05 != ""){ $nombre = $this->cotizaciones_model->getCotizacionPorId($dato->idc_05); echo "<li><a target='_blank' href='cotizaciones/search_cot/".$dato->idc_05."'>".$dato->idc_05.' - '.$nombre->producto; } ?><?php if($dato->idc_05 != ""){ $nombre = $this->cotizaciones_model->getCotizacionPorId($dato->idc_05); if($nombre->estan_los_moldes=="NO" && ($nombre->existe_trazado=="NO" || $nombre->existe_trazado=="")){echo "<a> - Por Definir</a>";}else if($nombre->estan_los_moldes=="NO" && $nombre->existe_trazado=="SI"){echo "<a>- Trazado:</a>".$nombre->trazado; $trazado = $this->trazados_model->getTrazadosPorId($nombre->trazado); echo "<a>.$trazado->estatus.</a>";}else if($nombre->estan_los_moldes=="MOLDE GENERICO"){echo "<a>- Molde:</a>".$nombre->numero_molde; $molde = $this->moldes_model->getMoldesPorId($nombre->numero_molde); echo "<a>.$molde->tipo.</a>";} } ?>
                        <?php if($dato->idc_06 != ""){ $nombre = $this->cotizaciones_model->getCotizacionPorId($dato->idc_06); echo "<li><a target='_blank' href='cotizaciones/search_cot/".$dato->idc_06."'>".$dato->idc_06.' - '.$nombre->producto; } ?><?php if($dato->idc_06 != ""){ $nombre = $this->cotizaciones_model->getCotizacionPorId($dato->idc_06); if($nombre->estan_los_moldes=="NO" && ($nombre->existe_trazado=="NO" || $nombre->existe_trazado=="")){echo "<a> - Por Definir</a>";}else if($nombre->estan_los_moldes=="NO" && $nombre->existe_trazado=="SI"){echo "<a>- Trazado:</a>".$nombre->trazado; $trazado = $this->trazados_model->getTrazadosPorId($nombre->trazado); echo "<a>.$trazado->estatus.</a>";}else if($nombre->estan_los_moldes=="MOLDE GENERICO"){echo "<a>- Molde:</a>".$nombre->numero_molde; $molde = $this->moldes_model->getMoldesPorId($nombre->numero_molde); echo "<a>.$molde->tipo.</a>";} } ?>
                        <?php if($dato->idc_07 != ""){ $nombre = $this->cotizaciones_model->getCotizacionPorId($dato->idc_07); echo "<li><a target='_blank' href='cotizaciones/search_cot/".$dato->idc_07."'>".$dato->idc_07.' - '.$nombre->producto; } ?><?php if($dato->idc_07 != ""){ $nombre = $this->cotizaciones_model->getCotizacionPorId($dato->idc_07); if($nombre->estan_los_moldes=="NO" && ($nombre->existe_trazado=="NO" || $nombre->existe_trazado=="")){echo "<a> - Por Definir</a>";}else if($nombre->estan_los_moldes=="NO" && $nombre->existe_trazado=="SI"){echo "<a>- Trazado:</a>".$nombre->trazado; $trazado = $this->trazados_model->getTrazadosPorId($nombre->trazado); echo "<a>.$trazado->estatus.</a>";}else if($nombre->estan_los_moldes=="MOLDE GENERICO"){echo "<a>- Molde:</a>".$nombre->numero_molde; $molde = $this->moldes_model->getMoldesPorId($nombre->numero_molde); echo "<a>.$molde->tipo.</a>";} } ?>
                        <?php if($dato->idc_08 != ""){ $nombre = $this->cotizaciones_model->getCotizacionPorId($dato->idc_08); echo "<li><a target='_blank' href='cotizaciones/search_cot/".$dato->idc_08."'>".$dato->idc_08.' - '.$nombre->producto; } ?><?php if($dato->idc_08 != ""){ $nombre = $this->cotizaciones_model->getCotizacionPorId($dato->idc_08); if($nombre->estan_los_moldes=="NO" && ($nombre->existe_trazado=="NO" || $nombre->existe_trazado=="")){echo "<a> - Por Definir</a>";}else if($nombre->estan_los_moldes=="NO" && $nombre->existe_trazado=="SI"){echo "<a>- Trazado:</a>".$nombre->trazado; $trazado = $this->trazados_model->getTrazadosPorId($nombre->trazado); echo "<a>.$trazado->estatus.</a>";}else if($nombre->estan_los_moldes=="MOLDE GENERICO"){echo "<a>- Molde:</a>".$nombre->numero_molde; $molde = $this->moldes_model->getMoldesPorId($nombre->numero_molde); echo "<a>.$molde->tipo.</a>";} } ?>
                        <?php if($dato->idc_09 != ""){ $nombre = $this->cotizaciones_model->getCotizacionPorId($dato->idc_09); echo "<li><a target='_blank' href='cotizaciones/search_cot/".$dato->idc_09."'>".$dato->idc_09.' - '.$nombre->producto; } ?><?php if($dato->idc_09 != ""){ $nombre = $this->cotizaciones_model->getCotizacionPorId($dato->idc_09); if($nombre->estan_los_moldes=="NO" && ($nombre->existe_trazado=="NO" || $nombre->existe_trazado=="")){echo "<a> - Por Definir</a>";}else if($nombre->estan_los_moldes=="NO" && $nombre->existe_trazado=="SI"){echo "<a>- Trazado:</a>".$nombre->trazado; $trazado = $this->trazados_model->getTrazadosPorId($nombre->trazado); echo "<a>.$trazado->estatus.</a>";}else if($nombre->estan_los_moldes=="MOLDE GENERICO"){echo "<a>- Molde:</a>".$nombre->numero_molde; $molde = $this->moldes_model->getMoldesPorId($nombre->numero_molde); echo "<a>.$molde->tipo.</a>";} } ?>
                        <?php if($dato->idc_10 != ""){ $nombre = $this->cotizaciones_model->getCotizacionPorId($dato->idc_10); echo "<li><a target='_blank' href='cotizaciones/search_cot/".$dato->idc_10."'>".$dato->idc_10.' - '.$nombre->producto; } ?><?php if($dato->idc_10 != ""){ $nombre = $this->cotizaciones_model->getCotizacionPorId($dato->idc_10); if($nombre->estan_los_moldes=="NO" && ($nombre->existe_trazado=="NO" || $nombre->existe_trazado=="")){echo "<a> - Por Definir</a>";}else if($nombre->estan_los_moldes=="NO" && $nombre->existe_trazado=="SI"){echo "<a>- Trazado:</a>".$nombre->trazado; $trazado = $this->trazados_model->getTrazadosPorId($nombre->trazado); echo "<a>.$trazado->estatus.</a>";}else if($nombre->estan_los_moldes=="MOLDE GENERICO"){echo "<a>- Molde:</a>".$nombre->numero_molde; $molde = $this->moldes_model->getMoldesPorId($nombre->numero_molde); echo "<a>.$molde->tipo.</a>";} } ?>
                        <?php echo "</ul>"?></td>
                        <td><a style="text-decoration: none" data-toggle="modal" data-target="#myModal">Detalle</a></td>
                        <td><?php echo $dato->fecha_creacion?></td>
			<td>
                        <a href="<?php echo base_url()?>grupos/edit/<?php echo $dato->id?>" title="Editar"><i class="icon-pencil"></i></a>	
           		<a href="javascript:void(0);" onclick="eliminar('<?php echo base_url()?>grupos/delete/<?php echo $dato->id?>');" title="Eliminar"><i class="icon-trash"></i></a>	
            </td>
            <!-- Modal -->
<div id="myModal" class="modal fade" role="dialog">
    <div class="modal-dialog" id="mimodal">
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Detalle de Cotizacion Grupal</h4>
      </div>
      <div class="modal-body">
          <div class="container">
            <div class="row">
                      <div class="span3" style="background-color:yellow;">
                          <img src="http://imgcf.ecn.cl/600/d3/d3bf09b362cd3b464342bce5b0a70b6f1b56f417.bin.jpg" />
                      </div>
                      <div class="span3">
                         <div class="page-header">
                            <h4>Encabezado de página <small>con un texto secundario</small></h4>
                        </div>
                      </div>
<!--                 <div class="col-md-12">
                      <div class="col-sm-6">
                          <img src="http://www.creativeline.cl/wp-content/uploads/2016/11/paylover1.png" />
                      </div>
                      <div class="col-sm-6">
                          <img src="http://www.creativeline.cl/wp-content/uploads/2016/11/paylover1.png" />
                      </div>
                  </div>-->
            </div>
          </div>
       </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>
    </tbody>
    <?php
    }
    ?>
    
</table>
