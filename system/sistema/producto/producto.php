<link href="<?php echo $ruta_base;?>assets/plugins/jquery-datatable/skin/bootstrap/css/dataTables.bootstrap.css" rel="stylesheet">
<?php
    $codigo = $_POST[codigo];
    $nombrepro = $_POST[nombre];
    $descrip = $_POST[descrip];
    $tipov = $_POST[seltipov];
    $precio = $_POST[precio];
    $catego = $_POST[categoria];
    $eliminar = $_POST[eliminar];
    $editar = $_POST[editar];
    $ruta=$absolute_uri."assets/producto/$codigo.jpg";
	$existe = paraTodos::url_exists($ruta);
    if ($existe) {
        $foto = $ruta;
    } else {
        $foto = $ruta_base."assets/logos/none.png";
    }
    $consulprov = paraTodos::arrayConsulta("*", "proveedor", "prov_nit=$_SESSION[ci]");
    foreach($consulprov as $prov){
        $nombre = $prov[prov_razon];
        $provcodigo = $prov[prov_codigo];
        $resena = $prov[prov_resena];
    }
    if($editar==1 and $codigo==""){
        $insertar = paraTodos::arrayInserte("prod_provccodigo, prod_nombre, prod_descripcion, prod_precio, prod_tipoventa", "productos", "$catego,'$nombrepro', '$descrip', '$precio', $tipov");
        if($insertar){
            paraTodos::showMsg("Producto registrado exitosamente", "alert-success", "");
        }
    }
    if($editar==1 and $codigo!="" and $nombrepro!=""){
        $update = paraTodos::arrayUpdate("prod_provccodigo=$catego, prod_nombre='$nombrepro', prod_descripcion='$descrip', prod_precio='$precio', prod_tipoventa='$tipov'", "productos", "prod_codigo=$codigo");
        if($update){
            paraTodos::showMsg("Producto actualizado exitosamente", "alert-success", "");
        }
    }
    if($eliminar=="1"){
        $delete = paraTodos::arrayDelete("prod_codigo='$codigo'", "productos");
        if($delete){
            paraTodos::showMsg("Producto eliminado exitosamente", "alert-success", "");
        }
    }
    if($editar==1 and $codigo!="" and $catego==""){
        $consulcategoria = paraTodos::arrayConsulta("*", "productos", "prod_codigo=$codigo");
        foreach($consulcategoria as $categoria){
            $catego = $categoria[prod_provccodigo];
            $nombrepro = $categoria[prod_nombre];
            $descrip = $categoria[prod_descripcion];
            $tipov = $categoria[prod_tipoventa];
            $precio = $categoria[prod_precio];            
        }
    }
?>
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
                                <div class="col-sm-3">
                                    <div id="divfoto"> 
                                        <img id="foto" src="<?php echo $foto." ? ".rand();?>" width="350px;">
                                        <?php
                                            if($codigo!=""){
                                        ?>
                                        <a href="javascript:void(0)" id="subirfoto" onclick="
                                                $.ajax({
                                                type: 'POST',
                                                url: 'accion.php',
                                                data: {
                                                dmn :<?php echo $idMenut;?>,
                                                codigo :<?php echo $codigo;?>,
                                                act : 2,
                                                ver : 2
                                                },
                                                success: function(html) {
                                                $('#ventanaVer').html(html);
                                                },
                                                error: function(xhr,msg,excep) { alert('Error Status ' + xhr.status + ': ' + msg + '/ ' + excep); }
                                                });"> <i class="fa fa-camera" aria-hidden="true"></i> 
                                        </a>
                                        <?php
                                            }
                                        ?>
                                    </div>
                                </div>
                                <div class="col-sm-9">
                                    <div class="row">
                                        <form method="post" action="javascript:void(0)" onsubmit="
                                                    $.ajax({
                                                    url:'accion.php',
                                                    type:'POST',
                                                    data:{
                                                    dmn 	: <?php echo $idMenut;?>,
                                                    codigo 	: $('#codigo').val(),
                                                    nombre 	: $('#nombre').val(),
                                                    categoria 	: $('#selcategor').val(),
                                                    descrip 	: $('#descrip').val(),
                                                    seltipov 	: $('#seltipov').val(),
                                                    precio 	: $('#precio').val(),
                                                    editar: 1,
                                                    ver 	: 2
                                                    },
                                                    success : function (html) {
                                                    $('#page-content').html(html);
                                                    },
                                                    }); return false;">
                                            <div class="col-xs-12">
                                                <label>Categoría</label>
                                                <select class="form-control" id="selcategor">
                                                    <option value="0">Seleccione...</option>
                                                    <?php
                                                combos::CombosSelect("1", "$catego", "provc_codigo, provc_categoria", "provee_catego", "provc_codigo", "provc_categoria", "provc_provcodigo=$provcodigo");
                                                ?>
                                                </select>
                                            </div>
                                            <div class="col-xs-12">
                                                <label class="control-label">Título del producto</label>
                                                <input type="text" class="form-control" id="nombre" value="<?php echo $nombrepro;?>" required>
                                                <input type="hidden" id="codigo" value="<?php echo $codigo;?>"> </div>
                                            <div class="col-xs-12">
                                                <label class="control-label">Descripción del producto</label>
                                                <textarea class="form-control" id="descrip" rows="5"><?php echo $descrip;?></textarea>
                                            </div>
                                            <div class="col-xs-6">
                                                <label class="control-label">Tipo de venta</label>
                                                <select class="form-control" id="seltipov">
                                                    <option value="0">Seleccione...</option>
                                                    <?php
                                                combos::CombosSelect("1", "$tipov", "tipv_codigo, tipv_descripcion", "tool_tipoventa", "tipv_codigo", "tipv_descripcion", "1=1");
                                                ?>
                                                </select>
                                            </div>
                                            <div class="col-xs-6">
                                                <label class="control-label">Precio</label>
                                                <input type="number" class="form-control" id="precio" value="<?php echo $precio;?>" required> </div>
                                            <div class="row">
                                                <center>
                                                    <br>
                                                    <button type="submit" class="btn btn-default">Guardar</button>
                                                </center>
                                            </div>
                                        </form>
                                    </div>
                                    <div class="row">
                                        <div class="col-xs-12 sombra">
                                            <h4>Productos registrados</h4>                                            
                                        </div>
                                        <table class="" id="personal">
                                            <thead>
                                                <tr>
                                                    <td class="text-center"><strong>Categoría</strong></td>
                                                    <td class="text-center"><strong>Nombre</strong></td>
                                                    <td class="text-center"><strong>Descripción</strong></td>
                                                    <td class="text-center"><strong>Tipo de venta</strong></td>
                                                    <td class="text-center"><strong>Precio</strong></td>
                                                    <td class="text-center"><strong>Editar</strong></td>
                                                    <td class="text-center"><strong>Eliminar</strong></td>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
								            $consulsol = paraTodos::arrayConsulta("*", "productos p, provee_catego pc,tool_tipoventa t", "p.prod_provccodigo=pc.provc_codigo and p.prod_tipoventa=t.tipv_codigo and pc.provc_provcodigo=$provcodigo");
								            foreach($consulsol as $row){
?>
                                                    <tr>
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
                                                        <td class="text-center"> <a href="javascript:void(0);" onclick="$.ajax({
                                                                        url:'accion.php',
                                                                        type:'POST',
                                                                        data:{
                                                                        dmn 	: <?php echo $idMenut;?>,
                                                                        codigo 	: <?php echo $row[prod_codigo];?>,
                                                                        editar 	: 1,
                                                                        ver 	: 2
                                                                        },
                                                                        success : function (html) {
                                                                        $('#page-content').html(html);
                                                                        },
                                                                        }); return false;"><i class="fa fa-edit"></i>
                                                            </a> </td>
                                                        <td class="text-center">
                                                            <a href="javascript:void(0);" onclick="$.ajax({
                                                                        url:'accion.php',
                                                                        type:'POST',
                                                                        data:{
                                                                        dmn 	: <?php echo $idMenut;?>,
                                                                        codigo 	: <?php echo $row[prod_codigo];?>,
                                                                        eliminar : 1,
                                                                        ver 	: 2
                                                                        },
                                                                        success : function (html) {
                                                                        $('#page-content').html(html);
                                                                        $('#codigo').val('');                                                                                           
                                                                        },
                                                                        }); return false;"> <i class="fa fa-eraser"></i> </a>
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