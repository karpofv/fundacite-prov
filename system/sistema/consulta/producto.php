<link href="<?php echo $ruta_base;?>assets/plugins/jquery-datatable/skin/bootstrap/css/dataTables.bootstrap.css" rel="stylesheet">
    <div class="content">
        <div>
            <div class="page-header-title">
                <h4 class="page-title">Tus Productos</h4> </div>
        </div>
        <div class="page-content-wrapper ">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <div class="panel panel-primary">
                            <div class="panel-body">
                                <div class="col-sm-12">
                                    <div class="row">
                                        <div class="col-xs-12 sombra">
                                            <h4>Productos registrados</h4>                                            
                                        </div>
                                        <table class="" id="personal">
                                            <thead>
                                                <tr>
                                                    <td class="text-center"><strong>Proveedor</strong></td>
                                                    <td class="text-center"><strong>Categoría</strong></td>
                                                    <td class="text-center"><strong>Nombre</strong></td>
                                                    <td class="text-center"><strong>Descripción</strong></td>
                                                    <td class="text-center"><strong>Tipo de venta</strong></td>
                                                    <td class="text-center"><strong>Precio</strong></td>
                                                    <td class="text-center"><strong>Ver</strong></td>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
								            $consulsol = paraTodos::arrayConsulta("*", "productos p, provee_catego pc,tool_tipoventa t, proveedor pr", "p.prod_provccodigo=pc.provc_codigo and p.prod_tipoventa=t.tipv_codigo and pc.provc_provcodigo=pr.prov_codigo");
								            foreach($consulsol as $row){
?>
                                                    <tr>
                                                        <td class="text-center">
                                                            <?php echo $row[prov_razon];?>
                                                        </td>
                                                        <td class="text-center">
                                                            <?php echo $row[provc_categoria];?>
                                                        </td>
                                                        <td class="text-center">
                                                            <?php echo $row[prod_nombre];?>
                                                        </td>
                                                        <td class="text-center">
                                                            <?php echo $row[prod_descripcion];?>
                                                        </td>
                                                        <td class="text-center">
                                                            <?php echo $row[tipv_descripcion];?>
                                                        </td>
                                                        <td class="text-center">
                                                            <?php echo $row[prod_precio];?>
                                                        </td>
                                                        <td class="text-center">
                                                            <a href="javascript:void" 
                                                               onclick="$.ajax({
                                                type: 'POST',
                                                url: 'accion.php',
                                                data: {
                                                dmn :<?php echo $idMenut;?>,
                                                codigo :<?php echo $row[prod_codigo];?>,
                                                act : 2,
                                                ver : 2
                                                },
                                                success: function(html) {
                                                $('#ventanaVer').html(html);
                                                },
                                                error: function(xhr,msg,excep) { alert('Error Status ' + xhr.status + ': ' + msg + '/ ' + excep); }
                                                });">
                                                                <i class="fa fa-picture-o" aria-hidden="true"></i></a>
                                                        </td>
                                                    </tr>
                                                    <?php
								            }
?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Jquery DataTable Plugin Js -->
    <script src="<?php echo $ruta_base?>assets/plugins/jquery-datatable/jquery.dataTables.js"></script>
    <script src="<?php echo $ruta_base?>assets/plugins/jquery-datatable/skin/bootstrap/js/dataTables.bootstrap.js"></script>
    <script src="<?php echo $ruta_base?>assets/plugins/jquery-datatable/extensions/export/dataTables.buttons.min.js"></script>
    <script src="<?php echo $ruta_base?>assets/plugins/jquery-datatable/extensions/export/buttons.flash.min.js"></script>
    <script src="<?php echo $ruta_base?>assets/plugins/jquery-datatable/extensions/export/jszip.min.js"></script>
    <script src="<?php echo $ruta_base?>assets/plugins/jquery-datatable/extensions/export/pdfmake.min.js"></script>
    <script src="<?php echo $ruta_base?>assets/plugins/jquery-datatable/extensions/export/vfs_fonts.js"></script>
    <script src="<?php echo $ruta_base?>assets/plugins/jquery-datatable/extensions/export/buttons.html5.min.js"></script>
    <script src="<?php echo $ruta_base?>assets/plugins/jquery-datatable/extensions/export/buttons.print.min.js"></script>
    <script>
        $('#personal').DataTable({
            "language": {
                "url": "<?php echo $ruta_base;?>assets/js/Spanish.json"
            }
        });
    </script>