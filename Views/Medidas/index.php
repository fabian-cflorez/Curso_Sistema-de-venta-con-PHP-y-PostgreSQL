<?php include "Views/Templates/header.php"?>
<ol class="breadcrumb mb-4">
    <li class="breadcrumb-item active">Medidas</li>
</ol>
<!-- Boton que ejecutara la funcion frmUsuario() del archivo funciones.js -->
<button class="btn btn-primary mb-2" type="button" onclick="frmMedidas();">Nueva medida<i class="fas fa-plus ml-2"></i> </button>
<table class="table table-light" id="tblMedidas">
    <thead class="thead-dark">
        <tr>
            <th>Id</th>
            <th>Nombre</th>
            <th>Nombre corto</th>
            <th>Estado</th>
            <th>Acciones</th>
        </tr>
    </thead>
    <tbody>
    </tbody>
</table>
<!-- Se crea el modal del nuevo usuario que se ejecutara cuando se presione el boton Nuevo usuario -->
<div id="nuevo_medidas" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="my-modal-title" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <h5 class="modal-title text-white" id="title">Nuevo usuario</h5>
                <button class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="post" id="frmMedidas">
                    <div class="form-group">
                        <input type="hidden" id="id" name="id">
                        <label for="nombre">Nombre</label>
                        <input id="nombre" class="form-control" type="text" name="nombre" placeholder="Nombre medida">
                    </div>
                    <div class="form-group">
                        <label for="nombre_corto">Nombre corto</label>
                        <input id="nombre_corto" class="form-control" type="text" name="nombre_corto" placeholder="Nombre corto de medida">
                    </div>
                    <button class="btn btn-primary" type="button" id="btnAccion" onclick="registrarMed(event);">Registrar</button>
                    <button class="btn btn-danger" type="button" data-dismiss="modal">Cancelar</button>
                </form>
            </div>
        </div>
    </div>
</div>
<?php include "Views/Templates/Footer.php"?>