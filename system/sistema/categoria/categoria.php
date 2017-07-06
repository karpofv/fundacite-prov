<link href="<?php echo $ruta_base;?>assets/plugins/jquery-datatable/skin/bootstrap/css/dataTables.bootstrap.css" rel="stylesheet">
<?php
	$codigo = $_POST[codigo];
	$categoria = $_POST[categoria];
	$eliminar = $_POST[eliminar];
	$editar = $_POST[editar];
    $consulprov = paraTodos::arrayConsulta("prov_codigo", "proveedor", "prov_nit=$_SESSION[ci]");
    foreach($consulprov as $prov){
        $provcodigo = $prov[prov_codigo];
    }
    if($editar==1 and $codigo==""){
        $insertar = paraTodos::arrayInserte("provc_provcodigo, provc_categoria", "provee_catego", "$provcodigo,'$categoria'");
        if($insertar){
            paraTodos::showMsg("Categoría creada exitosamente", "alert-success", "");
        }
    }
    if($editar==1 and $codigo!="" and $categoria!=""){
        $update = paraTodos::arrayUpdate("provc_categoria='$categoria'", "provee_catego", "provc_codigo=$codigo");
        if($update){
            paraTodos::showMsg("Categoría actualizada exitosamente", "alert-success", "");
        }
    }
    if($eliminar=="1"){
        $delete = paraTodos::arrayDelete("provc_codigo='$codigo'", "provc_categoria");
        if($delete){
            paraTodos::showMsg("Categoría eliminada exitosamente", "alert-success", "");
        }
    }
    if($editar==1 and $codigo!="" and $categoria==""){
        $consulcategoria = paraTodos::arrayConsulta("*", "provee_catego", "provc_codigo=$codigo");
        foreach($consulcategoria as $catego){
            $categoria = $catego[provc_categoria];
        }
    }
?>
    <div class="content">
        <div>
            <div class="page-header-title">
                <h4 class="page-title">Proveedor</h4> </div>
        </div>
        <div class="page-content-wrapper ">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <div class="panel panel-primary">
                            <div class="panel-body">
                                <h4 class="m-b-30 m-t-0">Registro de proveedores</h4>
                                <div class="row">
                                    <form class="form-horizontal" method="post" enctype="application/x-www-form-urlencoded" action="javascript:void(0)" onsubmit="$.ajax({
								url:'accion.php',
								type:'POST',
								data:{
									dmn 	: <?php echo $idMenut;?>,
									prov 	: <?php echo $_SESSION[ci];?>,
									codigo 	: $('#codigo').val(),
									categoria 	: $('#categoria').val(),
									editar: 1,
									ver 	: 2
								},
								success : function (html) {
									$('#page-content').html(html);        
								},
							}); return false">
                                        <div class="form-group" style="display: block;">
                                            <label class="col-sm-2 control-label" for="nombre">Categoría</label>
                                            <div class="col-sm-8">
                                                <input class="form-control" id="categoria" type="text" value="<?php echo $categoria;?>">
                                                <input class="form-control" id="codigo" type="hidden" value="<?php echo $codigo;?>">
                                            </div>
                                        </div>
                                        <div class="box-footer">
                                            <input id="enviar" type="submit" value="Guardar" class="btn btn-primary col-md-offset-5">
                                        </div>
                                    </form>
                                </div>
                                <?php 
                                if($accPermisos[S]==1){
                                ?>
                                    <div class="row">
                                        <table class="" id="personal">
                                            <thead>
                                                <tr>
                                                    <td class="text-center"><strong>Categoría</strong></td>
                                                    <td class="text-center"><strong>Editar</strong></td>
                                                    <td class="text-center"><strong>Eliminar</strong></td>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
								            $consulsol = paraTodos::arrayConsulta("*", "provee_catego", "provc_provcodigo=$provcodigo");
								            foreach($consulsol as $row){
?>
                                                    <tr>
                                                        <td class="text-center">
                                                            <?php echo $row[provc_categoria];?>
                                                        </td>
                                                        <td class="text-center"> 
                                                            <a href="javascript:void(0);" 
                                                               onclick="$.ajax({
                                                                        url:'accion.php',
                                                                        type:'POST',
                                                                        data:{
                                                                        dmn 	: <?php echo $idMenut;?>,
                                                                        codigo 	: <?php echo $row[provc_codigo];?>,
                                                                        editar 	: 1,
                                                                        ver 	: 2
                                                                        },
                                                                        success : function (html) {
                                                                        $('#page-content').html(html);
                                                                        },
                                                                        }); return false;"><i class="fa fa-edit"></i>
                                                            </a> 
                                                        </td>
                                                        <td class="text-center">
                                                            <a href="javascript:void(0);" 
                                                               onclick="$.ajax({
                                                                        url:'accion.php',
                                                                        type:'POST',
                                                                        data:{
                                                                        dmn 	: <?php echo $idMenut;?>,
                                                                        codigo 	: <?php echo $row[provc_codigo];?>,
                                                                        eliminar : 1,
                                                                        ver 	: 2
                                                                        },
                                                                        success : function (html) {
                                                                        $('#page-content').html(html);
                                                                        $('#codigo').val('');                                                                                           
                                                                        },
                                                                        }); return false;">
                                                                <i class="fa fa-eraser"></i>
                                                            </a>
                                                        </td>
                                                    </tr>
                                                    <?php
								            }
?>
                                            </tbody>
                                        </table>
                                    </div>
                                    <?php
                                }
                                ?>
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