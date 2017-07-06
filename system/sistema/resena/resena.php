<?php
	$ruta=$absolute_uri."assets/logos/$_SESSION[ci].jpg";
	$existe = paraTodos::url_exists($ruta);
    if ($existe) {
        $foto = $ruta;
    } else {
        $foto = $ruta_base."assets/logos/none.png";
    }
    $resena = $_POST[resena];
    $consulprov = paraTodos::arrayConsulta("*", "proveedor", "prov_nit=$_SESSION[ci]");
    foreach($consulprov as $prov){
        $nombre = $prov[prov_razon];
        $codigo = $prov[prov_codigo];
        $resena = $prov[prov_resena];
    }
    if($_POST[editar]==1){
        $update= paraTodos::arrayUpdate("prov_resena='$resena'", "proveedor", "prov_codigo=$codigo");
    }
?>
<div class="content">
    <div>
        <div class="page-header-title">
            <h4 class="page-title">Tu Perfil</h4> </div>
    </div>
    <div class="page-content-wrapper ">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="panel panel-primary">
                        <div class="panel-body">
                            <div class="col-sm-3">
                                <div id="divfoto">
                                    <img id="foto" src="<?php echo $foto." ? ".rand();?>">
                                    <a href="javascript:void(0)" id="subirfoto"
                                       onclick="
                                                $.ajax({
                                                type: 'POST',
                                                url: 'accion.php',
                                                data: {
                                                dmn :<?php echo $idMenut;?>,
                                                act : 2,
                                                ver : 2
                                                },
                                                success: function(html) {
                                                $('#ventanaVer').html(html);
                                                },
                                                error: function(xhr,msg,excep) { alert('Error Status ' + xhr.status + ': ' + msg + '/ ' + excep); }
                                                });">
                                        <i class="fa fa-camera" aria-hidden="true"></i>
                                    </a>
                                </div>
                            </div>
                            <div class="col-sm-9">
                                <div class="row sombra">
                                    <h4><?php echo $nombre;?></h4>
                                </div>
                                <div class="row">
                                    <form method="post" action="javascript:void(0)"
                                          onsubmit="
                                                    $.ajax({
                                                    url:'accion.php',
                                                    type:'POST',
                                                    data:{
                                                    dmn 	: <?php echo $idMenut;?>,
                                                    resena 	: $('#txtresena').val(),
                                                    editar: 1,
                                                    ver 	: 2
                                                    },
                                                    success : function (html) {
                                                    $('#page-content').html(html);
                                                    },
                                                    }); return false;">
                                        <label>Tu Reseña</label>
                                        <textarea id="txtresena" class="form-control" rows="10"><?php echo $resena;?></textarea>
                                        <center>
                                            <button type="submit" class="btn btn-default">Enviar</button>                                            
                                        </center>
                                    </form>                                        
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>