
<?php include "Views/Templates/header.php"?>
<div class="card mb-2">
    <div class="card-header bg-primary text-white">
        <h4>Nueva compra</h4>
    </div>
    <div class="card-body">
        <form id="frmCompra">
            <div class="row">
                <div class="col-md-3">
                    <div class="form-group">
                        <input type="hidden" id="id" name="id">
                        <label for="codigo"><i class="fas fa-barcode mr-1"></i>Código de barras</label>
                        <input id="codigo" class="form-control" type="text" name="codigo" placeholder="Código de barras" onkeyup="buscarCodigo(event)">
                    </div>
                </div>
                <div class="col-md-5">
                    <div class="form-group">
                        <label for="nombre">Descripción</label>
                        <input id="nombre" class="form-control" type="text" name="nombre" placeholder="Descripcion de producto" disabled>
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="form-group">
                        <label for="cantidad">Cantidad</label>
                        <input id="cantidad" class="form-control" type="number" name="cantidad" onkeyup="calcularPrecio(event)" disabled>
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="form-group">
                        <label for="precio">Precio</label>
                        <input id="precio" class="form-control" type="text" name="precio" placeholder="Código de barras" disabled>
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="form-group">
                        <label for="sub_total">Subtotal</label>
                        <input id="sub_total" class="form-control" type="text" name="sub_total" placeholder="Sub total" disabled>
                    </div>
                </div>
                
            </div>
        </form>
    </div>
</div>

<table class="table table-light table-bordered table-hover">
    <thead class="thead-dark">
        <tr>
            <th>Id</th>
            <!--<th>Código</th>-->
            <th>Descripción</th>
            <th>Cantidad</th>
            <th>Precio</th>
            <th>SubTotal</th>
            <th>Opciones</th>
        </tr>
    </thead>
    <tbody id="tblDetalle">
    </tbody>
</table>

<div class="row">
    <div class="col-md-4 ml-auto">
        <div class="form-group">
            <label for="total" class="font-weight-bold">Total</label>
            <input id="total" class="form-control" type="text" name="total" disabled>
            <button class="btn btn-primary mt-2 btn-block" type="button" onclick="generarCompra()">Generar compra</button>
        </div>
    </div>
</div>


<?php include "Views/Templates/Footer.php"?>
