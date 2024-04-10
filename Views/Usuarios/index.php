<?php
    //Este archivo se ejecuta desde la funcion index del controlador index.php de la carpeta Controller
    //Se imprimen los datos de la sesion (A manera de prueba)
    //print_r($_SESSION);  
?>
<?php include "Views/Templates/header.php"?>
<ol class="breadcrumb mb-4">
    <li class="breadcrumb-item active">Usuarios</li>
</ol>
<!-- Boton que ejecutara la funcion frmUsuario() del archivo funciones.js -->
<button class="btn btn-primary mb-2" type="button" onclick="frmUsuario();">Nuevo usuario<i class="fas fa-plus"></i> </button>
<table class="table table-light" id="tblUsuarios">
    <thead class="thead-dark">
        <tr>
            <th>Id</th>
            <th>Usuario</th>
            <th>Nombre</th>
            <th>Caja</th>
            <th>Estado</th>
            <th>Acciones</th>
        </tr>
    </thead>
    <tbody>
    </tbody>
</table>
<!-- Se crea el modal del nuevo usuario que se ejecutara cuando se presione el boton Nuevo usuario -->
<div id="nuevo_usuario" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="my-modal-title" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <h5 class="modal-title text-white" id="title">Nuevo usuario</h5>
                <button class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="post" id="frmUsuario">
                    <div class="form-group">
                        <input type="hidden" id="id" name="id">
                        <label for="usuario">Usuario</label>
                        <input id="usuario" class="form-control" type="text" name="usuario" placeholder="Usuario">
                    </div>
                    <div class="form-group">
                        <label for="nombre">Nombre</label>
                        <input id="nombre" class="form-control" type="text" name="nombre" placeholder="Nombre del usuario">
                    </div>
                    <div class="row" id="claves">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="clave">Contraseña</label>
                                <input id="clave" class="form-control" type="password" name="clave" placeholder="Ingrese la contraseña">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="confirmar">Confirmar la contraseña</label>
                                <input id="confirmar" class="form-control" type="password" name="confirmar" placeholder="Confirma la contraseña">
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="caja">Caja</label>
                        <select id="caja" class="form-control" name="caja">
                            <!--Se recorre con el foreach para obtener los resultados de la consulta-->
                            <?php foreach($data['cajas'] as $row) { ?>
                                <!-- Entre corchete el nombre de la tabla-->
                                <option value="<?php echo $row['id'];?>"><?php echo $row['caja'];?></option>
                            <?php }?>
                        </select>
                    </div>
                    <button class="btn btn-primary" type="button" id="btnAccion" onclick="registrarUser(event);">Registrar</button>
                    <button class="btn btn-danger" type="button" data-dismiss="modal">Cancelar</button>
                </form>
            </div>
        </div>
    </div>
</div>
<?php include "Views/Templates/Footer.php"?>
