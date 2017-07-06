<?php
	session_start();
    $_SESSION['codprod']=$_POST[codigo];
	$ruta=$absolute_uri."assets/producto/$_POST[codigo].jpg";
	$existe = paraTodos::url_exists($ruta);
    if ($existe) {
        $foto = $ruta;
    } else {
        $foto = $ruta_base."assets/logos/none.png";
    }
?>
    <div class="modal-backdrop fade in"></div>
    <div id="custom-width-modal" class="modal fade in" tabindex="-1" role="dialog" aria-labelledby="custom-width-modalLabel" aria-hidden="true" style="display: block; padding-right: 16px;">
        <div class="modal-dialog" style="width:50%">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true" onclick="cerrarmodal()">×</button>
                    <h4 class="modal-title" id="custom-width-modalLabel">Imagen del producto</h4>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="box box-solid box-warning">
                            <div class="col-xs-12 box-body content-archivo" id="foto-actual">
                                    <center>                                
                                <div id="divfoto">
                                    <img id="foto" src="<?php echo $foto." ? ".rand();?>">                                                                        
                                </div>
                                    </center>                                        
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>