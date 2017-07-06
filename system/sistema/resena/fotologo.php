<?php
	$ruta=$absolute_uri."assets/logos/$_SESSION[ci].jpg";
	$existe = paraTodos::url_exists($ruta);
    if ($existe) {
        $foto = $ruta;
    } else {
        $foto = $ruta_base."assets/logos/none.png";
    }
    $consulprov = paraTodos::arrayConsulta("*", "proveedor", "prov_nit=$_SESSION[ci]");
    foreach($consulprov as $prov){
        $nombre = $prov[prov_razon];
        $codigo = $prov[prov_codigo];
        $resena = $prov[prov_resena];
    }
?>
    <div class="modal-backdrop fade in"></div>
    <div id="custom-width-modal" class="modal fade in" tabindex="-1" role="dialog" aria-labelledby="custom-width-modalLabel" aria-hidden="true" style="display: block; padding-right: 16px;">
        <div class="modal-dialog" style="width:90%">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true" onclick="cerrarmodal()">×</button>
                    <h4 class="modal-title" id="custom-width-modalLabel">Subir Imagen</h4>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="box box-solid box-warning">
                            <div class="box-header">
                                <h3 class="box-title">Actualizar Imagen</h3>
                            </div>
                            <div class="col-xs-6 box-body content-archivo">
                                <div tabindex="500" class="btn btn-primary btn-file" id="selarchivo"> <i class="glyphicon glyphicon-folder-open"><span class="">  Seleccione la imagen</span></i>
                                    <input id="archivoImage<?php echo $_SESSION['ci'];?>" name="archivoImage<?php echo $_SESSION['ci'];?>" type="file" class="file"> </div>
                                <input id="botonSubidor" type="button" class="btn btn-default" value="Actualizar" onclick="
													var inputFileImage = document.getElementById('archivoImage<?php echo $_SESSION['ci'];?>');
													var file = inputFileImage.files[0];
													var data = new FormData();
													data.append('archivo',file);
													var url = '<?php echo $ruta_base;?>assets/plugins/upload/upload.php';
													$.ajax({
														url:url,
														type:'POST',
														contentType:false,
														data:data,
														data:data,
														processData:false,
														success : function (msg) {
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
        											});
														}
													});">
                                <h5><b>Nota: </b>* El tamaño de la imagen no deberá ser mayor a 200kb.<br>* El formato de la imagen debera ser .JPG</h5>
                                <br>
                            </div>
                            <div class="col-xs-6 box-body content-archivo" id="foto-actual">
                                <div id="divfoto">
                                    <img id="foto" src="<?php echo $foto." ? ".rand();?>">                                
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>