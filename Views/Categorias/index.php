<?php
    //Este archivo se ejecuta desde la funcion index del controlador index.php de la carpeta Controller
    //Se imprimen los datos de la sesion (A manera de prueba)
    //print_r($_SESSION);  
?>
<?php include "Views/Templates/header.php"?>
<ol class="breadcrumb mb-4">
    <li class="breadcrumb-item active">Categorias</li>
</ol>
<!-- Boton que ejecutara la funcion frmUsuario() del archivo funciones.js -->
<button class="btn btn-primary mb-2" type="button" onclick="frmCategoria();">Nueva categoria<i class="fas fa-plus ml-2"></i> </button>
<table class="table table-light" id="tblCategoria">
    <thead class="thead-dark">
        <tr>
            <th>Id</th>
            <th>Nombre</th>
            <th>Estado</th>
            <th>Acciones</th>
        </tr>
    </thead>
    <tbody>
    </tbody>
</table>
<!-- Se crea el modal del nuevo usuario que se ejecutara cuando se presione el boton Nuevo usuario -->
<div id="nuevo_categoria" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="my-modal-title" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <h5 class="modal-title text-white" id="title">Nuevo usuario</h5>
                <button class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="post" id="frmCategoria">
                    <div class="form-group">
                        <input type="hidden" id="id" name="id">
                        <label for="nombre">Nombre</label>
                        <input id="nombre" class="form-control" type="text" name="nombre" placeholder="Nombre categoría">
                    </div>
                    <button class="btn btn-primary" type="button" id="btnAccion" onclick="registrarCat(event);">Registrar</button>
                    <button class="btn btn-danger" type="button" data-dismiss="modal">Cancelar</button>
                </form>
            </div>
        </div>
    </div>
</div>
<?php include "Views/Templates/Footer.php"?>
