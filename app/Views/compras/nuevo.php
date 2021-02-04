<?php
    $id_compra = uniqid();
?>
<div id="layoutSidenav_content">
    <main>
        <div class="container-fluid">
                       
            <div class="card mb-4">
                            
                <div class="card-body">
                    <form method="POST" id="form_compra" name="form_compra" action="<?php echo base_url(); ?>/compras/guardar" autocomplete="off">
                    <div class="form-group"> 
                        <div class="row">

                            <div class="col-12 col-sm-4">
                            <input type="hidden" id="id_producto" name="id_producto" />
                            <input type="hidden" id="id_compra" name="id_compra" value="<?php echo $id_compra;  ?>"/>
                                <label>Código</label>
                                <input class="form-control" id="codigo" type="text" name="codigo" autofocus placeholder="Escribe el código y presiona enter" onkeyup="buscarProducto(event, this, this.value)" />
                                <label for="codigo" id="resultado_error" style="color: red"></label>
                            </div>

                            <div class="col-12 col-sm-4">
                                <label>Nombre</label>
                                <input class="form-control" id="nombre" type="text" name="nombre" disabled />
                            </div>

                            <div class="col-12 col-sm-4">
                                <label>Cantidad</label>
                                <input class="form-control" id="cantidad" type="number" name="cantidad"  />
                            </div>

                        </div> 
                    </div>    

                    <div class="form-group"> 
                        <div class="row">

                            <div class="col-12 col-sm-4">
                                <label>Precio de Compra</label>
                                <input class="form-control" id="precio_compra" type="text" name="precio_compra"  disabled/>
                            </div>

                            <div class="col-12 col-sm-4">
                                <label>Subtotal</label>
                                <input class="form-control" id="subtotal" type="text" name="subtotal" disabled />
                            </div>

                            <div class="col-12 col-sm-4">
                                <label><br>&nbsp;</label>
                                <button id="agregar_producto" name="agregar_producto" type="button" class="btn btn-primary" onclick="agregarProducto(id_producto.value, cantidad.value, '<?php echo $id_compra; ?>')">Agregar Producto</button>
                            </div>

                        </div> 
                    </div>  
                    <div class="row" >
                        <table id="tablaProductos" class="table table-hover table-striped table-sm table-responsive tablaProductos" width="100%">
                            <thead class="thead-dark">
                                <th>#</th>
                                <th>Código</th>
                                <th>Nombre</th>
                                <th>Precio</th>
                                <th>Cantidad</th>
                                <th>Total</th>
                                <th width="1%"></th>

                            </thead>
                            <tbody></tbody>
                        </table>
                    </div>

                    <div class="row">
                        <div class="col-12 col-sm-6 offset-md-6">
                        <label style="font-weight:bold; font-size:30px; text-align:center ">Total S/.</label>
                        <input type="text" id="total" name="total" size="7" readonly=true value="0.00" style="font-weight:bold; font-size:30px; text-align:center "/>
                        <button type="button" class="btn btn-success" id="completa_compra">Completar Compra</button>     
                        </div>
                    </div>
                                  
                    </form>
                </div>
             </div>
        </div>
    </main>
  
    <script>
        $(document).ready(function() {
            $("#completa_compra").click(function() {
                let nFila = $("#tablaProductos tr").length;
                if(nFila < 2) {
                    //mensaje usando modal
                }else{
                    $("#form_compra").submit();
                }
            });
        });
     
        function buscarProducto(e, tagCodigo, codigo){
            var enterKey = 13;
            if(codigo != ''){
                if(e.keyCode == enterKey){
                    $.ajax({
                        url: '<?php echo base_url(); ?>/productos/buscarPorCodigo/' + codigo, dataType: 'json',
                        success: function(resultado){
                            if(resultado == 0){
                                $(tagCodigo).val('');
                            }else{
                                $(tagCodigo).removeClass('has-error');

                                $("#resultado_error").html(resultado.error);

                                if(resultado.existe){
                                    $("#id_producto").val(resultado.datos.id);  
                                    $("#nombre").val(resultado.datos.nombre);
                                    $("#cantidad").val(1);
                                    $("#precio_compra").val(resultado.datos.precio);
                                    $("#subtotal").val(resultado.datos.precio);
                                    $("#cantidad").focus();
                                }else{
                                    $("#id_producto").val('');
                                    $("#nombre").val('');
                                    $("#cantidad").val(1);
                                    $("#precio_compra").val('');
                                    $("#subtotal").val('');
                                }
                            }
                        }
                    });
                }
                
            }
        }

        function agregarProducto(id_producto, cantidad, id_compra){
            if(id_producto != null && id_producto != 0 && cantidad > 0){
                
                $.ajax({
                    url: '<?php echo base_url(); ?>/TemporalCompras/inserta/' + id_producto + "/" + cantidad + "/" + id_compra,
                    success: function(resultado){
                        if(resultado == 0){
                          
                        }else{
                            var resultado = JSON.parse(resultado);
                            if(resultado.error == ''){
                                $("#tablaProductos tbody").empty();
                                $("#tablaProductos tbody").append(resultado.datos);
                                $("#total").val(resultado.total);
                                $("#id_producto").val('');
                                $("#codigo").val('');
                                $("#nombre").val('');
                                $("#cantidad").val(1); 
                                $("#precio_compra").val('');
                                $("#subtotal").val('');
                            }
                        }
                    }
                });
            }
        }

        function eliminaProducto(id_producto, id_compra){
           
            $.ajax({
                url: '<?php echo base_url(); ?>/TemporalCompras/eliminar/' + id_producto + "/"+ id_compra,
                success: function(resultado){
                    if(resultado == 0){
                        $(tagCodigo).val('');
                    }else{
                        var resultado = JSON.parse(resultado); 
                        $("#tablaProductos tbody").empty();
                        $("#tablaProductos tbody").append(resultado.datos);
                        $("#total").val(resultado.total);        
                    }
                 }
            });
        }
    </script>