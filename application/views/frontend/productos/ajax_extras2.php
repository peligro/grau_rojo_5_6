<?php ?>
<div class="control-group">
<div class="controls">
    <table border='1' style="text-align: center; width: 1300px">
                <tr>
                    <th>Id</th>
                    <th>Ot</th>
                    <th>Ot Migrada</th>
                    <th>Cantidad</th>
                    <th>Precio Migrado</th>
                    <th>Precio Actual</th>
                    <th>Producto</th>
                    <!--<th>Descripcion</th>-->
                    <th>Fecha</th>
                </tr>
    <?php foreach ($extras as $key => $value) { $cliente = $value->razon_social;?>
                <tr>
                    <td><?php echo $value->id ?></td>
                    <td><?php echo $value->ot ?></td>
                    <td><?php echo $value->ot_migrada ?></td>
                    <td><?php echo $value->cantidad_1 ?></td>
                    <td><?php echo $value->precio_migrado ?></td>
                    <td><?php echo $value->precio ?></td>
                    <td><?php echo $value->producto ?></td>
                    <!--<td><?php// echo $value->nombre_producto ?></td>-->
                    <td><?php echo $value->fecha ?></td>
                </tr>
    <?php } ?>
            </table>
    <br />
    <br />
    <h4 class="modal-title">Datos Cotizaciones Anteriores</h4><br />
    <table>
        <tr>
            <th>Cliente: </th>
            <th><?php echo $value->razon_social; ?></th>
            <th>&nbsp;&nbsp;&nbsp;</th>
            <th>Nro:<?php echo $idcliente; ?></th>
        </tr>
    </table><br />
    <table border='1' style="text-align: center; font-size: 12px;  width: 1300px">
                <tr>
                    <th>Id</th>
                    <th>Ot</th>
                    <th>Producto</th>
                    <th>Cantidad 1</th>
                    <th>Precio Migrado</th>
                    <th>Precio Actual</th>
                    <th>Ot Antigua</th>
                    <th>Ot Migrada</th>
                    <th>Fecha</th>
                </tr>
    <?php 
 
    foreach ($cot as $key => $value) {?>
                <tr>
                    <td><?php echo $value->id ?></td>
                    <td><?php echo $value->ot ?></td>
                    <td><?php echo $value->producto ?></td>
                    <td><?php echo $value->cantidad_1 ?></td>
                    <td><?php echo $value->precio_migrado ?></td>
                    <td><?php echo $value->precio ?></td>
                    <td><?php echo $value->ot_antigua ?></td>
                    <td><?php echo $value->ot_migrada ?></td>
                    <td><?php echo $value->fecha?></td>
                </tr>
    <?php } ?>
            </table>
</div>
</div>