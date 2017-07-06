<?php
    $codigo=$_POST[codigo];
?>
<div class="content">
    <div>
        <div class="page-header-title">
            <h4 class="page-title">Galería de productos por proveedor</h4> </div>
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
                                        <h4>Proveedores registrados</h4> </div>
                                    <select class="form-control" 
                                            onchange="$.ajax({
                                                type: 'POST',
                                                url: 'accion.php',
                                                data: {
                                                dmn :<?php echo $idMenut;?>,
                                                codigo :$('#selprovee').val(),
                                                ver : 2
                                                },
                                                success: function(html) {
                                                $('#page-content').html(html);
                                                },
                                                error: function(xhr,msg,excep) { alert('Error Status ' + xhr.status + ': ' + msg + '/ ' + excep); }
                                                });" id="selprovee">
                                        <option value="0">Seleccione...</option>
                                        <?php
                                            combos::CombosSelect("1", "$codigo", "prov_codigo, prov_razon", "proveedor", "prov_codigo", "prov_razon", "1=1");
                                            ?>
                                    </select>
                                </div>
                            </div>
                            <div class="col-xs-12" id="galeria">
                                <?php
                                    $consulproduc = paratodos::arrayConsulta("*", "productos p, provee_catego pc, tool_tipoventa t", "p.prod_provccodigo=pc.provc_codigo and pc.provc_provcodigo=$codigo and p.prod_tipoventa=t.tipv_codigo");
                                    foreach($consulproduc as $produc){
                                        $ruta=$absolute_uri."assets/producto/$produc[prod_codigo].jpg";
                                        $existe = paraTodos::url_exists($ruta);
                                        if ($existe) {
                                            $foto = $ruta;
                                        } else {
                                            $foto = $ruta_base."assets/logos/none.png";
                                        }                                        
                                ?>
                                <div class="row sombra" style="background-color:white; border:solid 1px; border-color:white;">
                                    <div class="col-xs-2 fondo-imagen">
                                        <center>
                                            <img src="<?php echo $foto." ? ".rand();?>" class="foto-galeria">
                                        </center>                                            
                                    </div>
                                    <div class="col-xs-8">
                                        <h4><?php echo $produc[prod_nombre];?></h4>
                                        <p><?php echo $produc[prod_descripcion];?></p>
                                    </div>
                                    <div class="col-xs-2">
                                        <h4>Al <?php echo $produc[tipv_descripcion];?></h4>
                                        <h1 style="color:#3292e0"><?php echo number_format($produc[prod_precio],2,",", ".");?>Bs.F.</h1>
                                    </div>
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
</div>