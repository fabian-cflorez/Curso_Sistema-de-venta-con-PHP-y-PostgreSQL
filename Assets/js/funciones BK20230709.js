//Se reciben los datos desde usuario.php de Controllers de la funcion listar
let tblUsuarios, tblClientes, tblCategoria, tblMedidas, tblProductos;
//Se agrega escucha al documento cuando este se cargue
//Para los nombres de las tablas, se debe indicar el nombre de la columna de la base de datos
document.addEventListener("DOMContentLoaded", function()
{
    // INICIO DE LA TABLA USUARIOS
    tblUsuarios = $('#tblUsuarios').DataTable( {
        ajax:
        {
            url: base_url + "Usuarios/listar",
            dataSrc: ''
        },
        columns:
        [
            //Estos datos estan siendo obtenidos desde la consulta ejecutada en la funcion getUsuarios de UsuariosModel
            {'data':'id'},
            {'data':'usuario'},
            {'data':'nombre'},
            {'data':'caja'},
            {'data':'estado'},
            //Esta Acciones lo esta obteniendo desde el ciclo for de la funcion listar de Usuarios.php
            {'data':'acciones'}
        ]
    });
    // FIN DE LA TABLA USUARIOS
    // INICIO DE LA TABLA CLIENTES
    tblClientes = $('#tblClientes').DataTable( {
        ajax:
        {
            url: base_url + "Clientes/listar",
            dataSrc: ''
        },
        columns:
        [
            //Estos datos estan siendo obtenidos desde la consulta ejecutada en la funcion getUsuarios de UsuariosModel
            {'data':'id'},
            {'data':'dni'},
            {'data':'nombre'},
            {'data':'telefono'},
            {'data':'direccion'},
            {'data':'estado'},
            //Esta Acciones lo esta obteniendo desde el ciclo for de la funcion listar de Usuarios.php
            {'data':'acciones'}
        ]
    });
    // FIN DE LA TABLA CLIENTES
    // INICIO DE LA TABLA CATEGORIAS
    tblCategoria = $('#tblCategoria').DataTable( {
        ajax:
        {
            url: base_url + "Categorias/listar",
            dataSrc: ''
        },
        columns:
        [
            //Estos datos estan siendo obtenidos desde la consulta ejecutada en la funcion getUsuarios de UsuariosModel
            {'data':'id'},
            {'data':'nombre'},
            {'data':'estado'},
            //Esta Acciones lo esta obteniendo desde el ciclo for de la funcion listar de Usuarios.php
            {'data':'acciones'}
        ]
    });
    // FIN DE LA TABLA CATEGORIAS
    // INICIO DE LA TABLA MEDIDA
    tblMedidas = $('#tblMedidas').DataTable( {
        ajax:
        {
            url: base_url + "Medidas/listar",
            dataSrc: ''
        },
        columns:
        [
            //Estos datos estan siendo obtenidos desde la consulta ejecutada en la funcion getUsuarios de UsuariosModel
            {'data':'id'},
            {'data':'nombre'},
            {'data':'nombre_corto'},
            {'data':'estado'},
            //Esta Acciones lo esta obteniendo desde el ciclo for de la funcion listar de Usuarios.php
            {'data':'acciones'}
        ]
    });
    // FIN DE LA TABLA MEDIDAS
    // INICIO DE LA TABLA PRODUCTOS
    tblProductos = $('#tblProductos').DataTable( {
        ajax:
        {
            url: base_url + "Productos/listar",
            dataSrc: ''
        },
        columns:
        [
            //Estos datos estan siendo obtenidos desde la consulta ejecutada en la funcion getUsuarios de UsuariosModel
            {'data':'id'},
            {'data':'imagen'},
            {'data':'codigo'},
            {'data':'descripcion'},
            {'data':'precio_venta'},
            {'data':'cantidad'},
            {'data':'estado'},
            //Esta Acciones lo esta obteniendo desde el ciclo for de la funcion listar de Usuarios.php
            {'data':'acciones'}
        ],
        language: {
            "url": "//cdn.datatables.net/plug-ins/1.10.11/i18n/Spanish.json"
        },
        //dom: 'Bfrtip',
        //dom: '<"top"i>rt<"bottom"flp><"clear">',
        /*Codigo para generar los botones de Copy, Excel, CSV, PDF que se encuentran en los datables*/
        dom:"<'row'<'col-sm-4'l><'col-sm-4 text-center'B><'col-sm-4'f>>" + "<'row'<'col-sm-12'tr>>" + "<'row'<'col-sm-5'i><'col-sm-7'p>>",
        /*buttons: [
            'copyHtml5',
            'excelHtml5',
            'csvHtml5',
            'pdfHtml5'
        ]*/
        buttons : [{
            //Boton para Excel
            extend: 'excelHtml5',
            footer: true,
            Title: 'Excel',
            filename: 'export_filename',
            //Aqui se genera el boton personalizado
            text: '<span class="badge badge-success"><i class="fas fa-file-excel mr-1"></i>EXCEL</span>'

        },
        {
            //Boton para PDF
            extend: 'pdfHtml5',
            download: 'open',
            footer: true,
            Title: 'Reporte de Productos',
            filename: 'Reporte de Productos',
            //Aqui se genera el boton personalizado
            text: '<span class="badge badge-danger"><i class="fas fa-file-pdf mr-1"></i>PDF</span>',
            exportOptions:{
                columns: [0, ':visible']
            }
        },
        {
            //Boton para Copiar
            extend: 'copyHtml5',
            footer: true,
            Title: 'Reporte de productos',
            filename: 'Reporte de productos',
            //Aqui se genera el boton personalizado
            text: '<span class="badge badge-primary"><i class="fas fa-copy mr-1"></i>COPIAR</span>',
            exportOptions:{
                columns: [0, ':visible']
            }
        },
        {
            //Boton para CSV
            extend: 'csvHtml5',
            footer: true,
            Title: 'export_file_csv',
            filename: 'export_filename',
            //Aqui se genera el boton personalizado
            text: '<span class="badge badge-success"><i class="fas fa-file-csv mr-1"></i>CSV</span>',
        },
        {
            //Boton para Print
            extend: 'print',
            footer: true,
            Title: 'export_file_csv',
            filename: 'export_file_print',
            //Aqui se genera el boton personalizado
            text: '<span class="badge badge-light"><i class="fas fa-file-csv mr-1"></i>PRINT</span>',
        },
        {
            //Boton para Print
            extend: 'colvis',
            //Aqui se genera el boton personalizado
            text: '<span class="badge badge-info"><i class="fas fa-columns mr-2"></i>SELECT</span>',
            postfixButtons: ['colvisRestore']
        }
    ]
    });
    // FIN DE LA TABLA PRODUCTOS
    // INICIO DE LA TABLA HISTORIAL COMPRAS
    $('#t_historial_c').DataTable( {
        ajax:
        {
            url: base_url + "Compras/listar_historial",
            dataSrc: ''
        },
        columns:
        [
            //Estos datos estan siendo obtenidos desde la consulta ejecutada en la funcion getUsuarios de UsuariosModel
            {'data':'id'},
            {'data':'total'},
            {'data':'fecha'},
            //Esta Acciones lo esta obteniendo desde el ciclo for de la funcion listar de Usuarios.php
            {'data':'acciones'}
        ]
    });
})



//Funcion que se ejecutara cuando se presion el boton Nuevo usuario del index
function frmUsuario()
{
    document.getElementById("title").innerHTML = "Nuevo Usuario";
    document.getElementById("btnAccion").innerHTML = "Registrar usuario";
    document.getElementById("claves").classList.remove("d-none");
    document.getElementById("frmUsuario").reset();
    //Se especifica el nombre del formulario(#nuevo_usuario) y ademas se indica que se muestre(show)
    $("#nuevo_usuario").modal("show");
    document.getElementById("id").value = "";
}


//Esta funcion se ejecutara cuando se presione el boton Registrar del modal nuevo usuario
function registrarUser(e)
{
    //La funciones frmlogin se ejecuta cuando el usuario le da clic en el boton Login de la pagina de index
    //Se agrega la funciona preventDefault a la variable e para que no recargue la pagina automaticamente cuando
    //le den clic en el boton Login
    e.preventDefault();
    //Se crea la constante usuario y clave para asignarle el campo usuario de la pagina Index mediante
    //el documentgetELementById
    const usuario = document.getElementById("usuario");
    const nombre = document.getElementById("nombre");
    const clave = document.getElementById("clave");
    const confirmar = document.getElementById("confirmar");
    const caja = document.getElementById("caja");
    //Se procede a hacer validaciones de los campos
    if (usuario.value == "" || nombre.value == "" || caja.value=="")
    {
        Swal.fire(
            {
                position: 'center',
                icon: 'error',
                title: 'Todos los campos son obligatorios',
                showConfirmButton: true
                //timer: 1500
            }
        )
    }else{
        //Se asigna la url a la variable mas el controlador
        const url = base_url + "Usuarios/registrar";
        //Se obtiene el id frmlogin del index
        const frm = document.getElementById("frmUsuario");
        /*XMLHttpRequest es un objeto JavaScript que fue diseñado por Microsoft y adoptado por Mozilla,
        Apple y Google. Actualmente es un estándar de la W3C. Proporciona una forma fácil de obtener
        información de una URL sin tener que recargar la página completa*/
        //Se instancia el objeto XMLHttpRequest
        const http = new XMLHttpRequest();
        //Se abre una conexion por el metodo POST y se envia una URL como parametro y se indica que se va a ejecutar
        //de forma asincrona mediante el true
        http.open("POST", url, true);
        //Se realiza el envio de la peticion
        http.send(new FormData(frm));
        //Se va a verificar el estado
        http.onreadystatechange = function()
        {
            //si readyState == 4 y status == 200 significa que la respuesta esta lista
            if (this.readyState == 4 && this.status == 200)
            {
                //console.log(this.responseText);
                //Se almacena en la constante res la respuesta del servidor
                const res = JSON.parse(this.responseText);
                //console.log("registrarUser"+" "+res);
                if(res == "si")
                {
                    Swal.fire(
                        {
                            position: 'center',
                            icon: 'success',
                            title: 'Usuario registrado con exito',
                            showConfirmButton: true
                            //timer: 1500
                        }
                    )
                    frm.reset();
                    $("#nuevo_usuario").modal("hide");
                    tblUsuarios.ajax.reload();
                    //Metodo para recargar la pagina automaticamente
                    //location.reload();
                }else if(res == "modificado")
                {
                    Swal.fire(
                        {
                            position: 'center',
                            icon: 'success',
                            title: 'Usuario modificado con exito',
                            showConfirmButton: true
                            //timer: 1500
                        }
                    )
                    //Oculta el modal de nuevo_usuario
                    $("#nuevo_usuario").modal("hide");
                    //Para que recargue solamente el area en donde se encuentran los registros de los usuarios
                    tblUsuarios.ajax.reload();
                }else{
                    Swal.fire(
                        {
                            position: 'center',
                            icon: 'error',
                            title: res,
                            showConfirmButton: true
                            //timer: 1500
                        }
                    )
                }
            }
        }
    }
}


//Se crea la funcion que sera ejecutada al presionar el boton Editar mediante el onclick del archivo Usuarios.php
//Se recibe como parametro un id
function btnEditarUser(id)
{
    document.getElementById("title").innerHTML = "Actualizar Usuario";
    document.getElementById("btnAccion").innerHTML = "Modificar usuario";
    //Se asigna la url a la variable mas el controlador
    //Se llama al metodo editar del archivo usuarios.php
    const url = base_url + "Usuarios/editar/"+id;
    /*XMLHttpRequest es un objeto JavaScript que fue diseñado por Microsoft y adoptado por Mozilla,
    Apple y Google. Actualmente es un estándar de la W3C. Proporciona una forma fácil de obtener
    información de una URL sin tener que recargar la página completa*/
    //Se instancia el objeto XMLHttpRequest
    const http = new XMLHttpRequest();
    //Se abre una conexion por el metodo POST y se envia una URL como parametro y se indica que se va a ejecutar
    //de forma asincrona mediante el true
    http.open("GET", url, true);
    //Se realiza el envio de la peticion
    http.send();
    //Se va a verificar el estado
    http.onreadystatechange = function()
    {
        //si readyState == 4 y status == 200 significa que la respuesta esta lista
        if (this.readyState == 4 && this.status == 200)
        {
            //console.log(this.responseText);
            //Se almacena en la constante res la respuesta del servidor
            const res = JSON.parse(this.responseText);
            //console.log(res);
            document.getElementById("id").value = res.id;
            document.getElementById("usuario").value = res.usuario;
            document.getElementById("nombre").value = res.nombre;
            document.getElementById("caja").value = res.id_caja;
            //Le agrega una clase de bootstrap para que oculte el div claves cuando se abre el modal de
            //modificar usuario
            document.getElementById("claves").classList.add("d-none");
            $("#nuevo_usuario").modal("show");
            
        }
    }
    
}


function btnEliminarUser(id)
{
    //document.getElementById("title").innerHTML = "Eliminar usuario";
    //document.getElementById("btnAccion").innerHTML = "Eliminar usuario";
    //alert(id);
    Swal.fire(
        {
            title: 'Estas seguro?',
            text: "Esta acción no se podra revertir!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Eliminar',
            cancelButtonText: 'No eliminar'
        }
    ).then((result) =>
        {
            if (result.isConfirmed)
            {
                //Se asigna la url a la variable mas el controlador
                //Se llama al metodo editar del archivo usuarios.php
                const url = base_url + "Usuarios/eliminar/"+id;
                /*XMLHttpRequest es un objeto JavaScript que fue diseñado por Microsoft y adoptado por Mozilla,
                Apple y Google. Actualmente es un estándar de la W3C. Proporciona una forma fácil de obtener
                información de una URL sin tener que recargar la página completa*/
                //Se instancia el objeto XMLHttpRequest
                const http = new XMLHttpRequest();
                //Se abre una conexion por el metodo POST y se envia una URL como parametro y se indica que se va a ejecutar
                //de forma asincrona mediante el true
                http.open("GET", url, true);
                //Se realiza el envio de la peticion
                http.send();
                //Se va a verificar el estado
                http.onreadystatechange = function()
                {
                    //si readyState == 4 y status == 200 significa que la respuesta esta lista
                    if (this.readyState == 4 && this.status == 200)
                    {                            
                        //Se almacena en la constante res la respuesta del servidor
                        const res = JSON.parse(this.responseText);
                        //console.log(this.responseText);
                        if (res == "ok")
                        {
                            Swal.fire(
                                'Eliminar!',
                                'Ha sido eliminado',
                                'success'
                                )
                                tblUsuarios.ajax.reload();
                        }else{
                            Swal.fire(
                                'Mensaje de error!',
                                res,
                                'error'
                                )
                        }
                    }
                }
            }
        }
    )
}

function btnReingresarUser(id)
{
    //document.getElementById("title").innerHTML = "Eliminar usuario";
    //document.getElementById("btnAccion").innerHTML = "Eliminar usuario";
    //alert(id);
    Swal.fire(
        {
            title: 'Estas seguro de activar?',
            //text: "Esta acción no se podra revertir!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Activar',
            cancelButtonText: 'No activar'
        }
    ).then((result) =>
        {
            if (result.isConfirmed)
            {
                //Se asigna la url a la variable mas el controlador
                //Se llama al metodo editar del archivo usuarios.php
                const url = base_url + "Usuarios/reingresar/"+id;
                /*XMLHttpRequest es un objeto JavaScript que fue diseñado por Microsoft y adoptado por Mozilla,
                Apple y Google. Actualmente es un estándar de la W3C. Proporciona una forma fácil de obtener
                información de una URL sin tener que recargar la página completa*/
                //Se instancia el objeto XMLHttpRequest
                const http = new XMLHttpRequest();
                //Se abre una conexion por el metodo POST y se envia una URL como parametro y se indica que se va a ejecutar
                //de forma asincrona mediante el true
                http.open("GET", url, true);
                //Se realiza el envio de la peticion
                http.send();
                //Se va a verificar el estado
                http.onreadystatechange = function()
                {
                    //si readyState == 4 y status == 200 significa que la respuesta esta lista
                    if (this.readyState == 4 && this.status == 200)
                    {                            
                        //Se almacena en la constante res la respuesta del servidor
                        const res = JSON.parse(this.responseText);
                        //console.log(this.responseText);
                        if (res == "ok")
                        {
                            Swal.fire(
                                'Mensaje!',
                                'Usuario activado con exito',
                                'success'
                                )
                                tblUsuarios.ajax.reload();
                        }else{
                            Swal.fire(
                                'Mensaje de error!',
                                res,
                                'error'
                                )
                        }
                    }
                }
            }
        }
    )
}

// FIN CRUD USUARIOS ///////////////////////////////////////////////////////////////////////////////////
//- - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - 
// INICIO CRUD CLIENTES ////////////////////////////////////////////////////////////////////////////////

//Funcion que se ejecutara cuando se presion el boton Nuevo usuario del index
function frmCliente()
{
    document.getElementById("title").innerHTML = "Nuevo cliente";
    document.getElementById("btnAccion").innerHTML = "Registrar cliente";
    document.getElementById("frmCliente").reset();
    //Se especifica el nombre del formulario(#nuevo_usuario) y ademas se indica que se muestre(show)
    $("#nuevo_cliente").modal("show");
    document.getElementById("id").value = "";
}


//Esta funcion registrarCli se ejecutara cuando se presione el boton Registrar del modal nuevo usuario
/*El procedimiento de registrar un usuario o cliente, asi como modificarlos se genera cuando se le da
clic en el boton btnAccion del modal, alli realiza el llamado a la funcion registrarCli, en esta funcion
se evalua si los campos estan vacios, sino lo estan entonces configura la url con el metodo registrar 
del controlador Clientes (Clientes/registrar) y le envia los datos de la variable frm
*/
function registrarCli(e)
{
    //Se agrega la funciona preventDefault a la variable e para que no recargue la pagina automaticamente cuando
    //le den clic en el boton Login
    e.preventDefault();
    //Se crea la constante usuario y clave para asignarle el campo usuario de la pagina Index mediante
    //el documentgetELementById
    const dni = document.getElementById("dni");
    const nombre = document.getElementById("nombre");
    const telefono = document.getElementById("telefono");
    const direccion = document.getElementById("direccion");
    //Se procede a hacer validaciones de los campos
    if (dni.value == "" || nombre.value == "" || telefono.value == "" || direccion.value == "")
    {
        Swal.fire(
            {
                position: 'center',
                icon: 'error',
                title: 'Todos los campos son obligatorios',
                showConfirmButton: true
                //timer: 1500
            }
        )
    }else{
        //Se asigna la url a la variable mas el controlador
        const url = base_url + "Clientes/registrar";
        //Se obtiene el id frmCliente del index
        const frm = document.getElementById("frmCliente");
        /*XMLHttpRequest es un objeto JavaScript que fue diseñado por Microsoft y adoptado por Mozilla,
        Apple y Google. Actualmente es un estándar de la W3C. Proporciona una forma fácil de obtener
        información de una URL sin tener que recargar la página completa*/
        //Se instancia el objeto XMLHttpRequest
        const http = new XMLHttpRequest();
        //Se abre una conexion por el metodo POST y se envia una URL como parametro y se indica que se va a ejecutar
        //de forma asincrona mediante el true
        http.open("POST", url, true);
        //Se realiza el envio de la peticion
        http.send(new FormData(frm));
        //Se va a verificar el estado
        http.onreadystatechange = function()
        {
            //si readyState == 4 y status == 200 significa que la respuesta esta lista
            if (this.readyState == 4 && this.status == 200)
            {
                //console.log(this.responseText);
                //Se almacena en la constante res la respuesta del servidor
                const res = JSON.parse(this.responseText);
                //console.log("registrarUser"+" "+res);
                if(res == "si")
                {
                    Swal.fire(
                        {
                            position: 'center',
                            icon: 'success',
                            title: 'Cliente registrado con exito',
                            showConfirmButton: true
                            //timer: 1500
                        }
                    )
                    frm.reset();
                    $("#nuevo_cliente").modal("hide");
                    tblClientes.ajax.reload();
                    //Metodo para recargar la pagina automaticamente
                    //location.reload();
                }else if(res == "modificado")
                {
                    Swal.fire(
                        {
                            position: 'center',
                            icon: 'success',
                            title: 'Cliente modificado con exito',
                            showConfirmButton: true
                            //timer: 1500
                        }
                    )
                    //Oculta el modal de nuevo_usuario
                    $("#nuevo_cliente").modal("hide");
                    //Para que recargue solamente el area en donde se encuentran los registros de los usuarios
                    tblClientes.ajax.reload();
                }else{
                    Swal.fire(
                        {
                            position: 'center',
                            icon: 'error',
                            title: res,
                            showConfirmButton: true
                            //timer: 1500
                        }
                    )
                }
            }
        }
    }
}


//Se crea la funcion que sera ejecutada al presionar el boton Editar mediante el onclick del archivo Usuarios.php
//Se recibe como parametro un id
function btnEditarCli(id)
{
    document.getElementById("title").innerHTML = "Actualizar Cliente";
    document.getElementById("btnAccion").innerHTML = "Modificar cliente";
    //Se asigna la url a la variable mas el controlador
    //Se llama al metodo editar del archivo usuarios.php
    const url = base_url + "Clientes/editar/"+id;
    /*XMLHttpRequest es un objeto JavaScript que fue diseñado por Microsoft y adoptado por Mozilla,
    Apple y Google. Actualmente es un estándar de la W3C. Proporciona una forma fácil de obtener
    información de una URL sin tener que recargar la página completa*/
    //Se instancia el objeto XMLHttpRequest
    const http = new XMLHttpRequest();
    //Se abre una conexion por el metodo POST y se envia una URL como parametro y se indica que se va a ejecutar
    //de forma asincrona mediante el true
    http.open("GET", url, true);
    //Se realiza el envio de la peticion
    http.send();
    //Se va a verificar el estado
    http.onreadystatechange = function()
    {
        //si readyState == 4 y status == 200 significa que la respuesta esta lista
        if (this.readyState == 4 && this.status == 200)
        {
            //console.log(this.responseText);
            //Se almacena en la constante res la respuesta del servidor
            const res = JSON.parse(this.responseText);
            //console.log(res);
            document.getElementById("id").value = res.id;
            document.getElementById("dni").value = res.dni;
            document.getElementById("nombre").value = res.nombre;
            document.getElementById("telefono").value = res.telefono;
            document.getElementById("direccion").value = res.direccion;
            //Le agrega una clase de bootstrap para que oculte el div claves cuando se abre el modal de
            //modificar usuario
            $("#nuevo_cliente").modal("show");
        }
    }
    
}


function btnEliminarCli(id)
{
    //document.getElementById("title").innerHTML = "Eliminar usuario";
    //document.getElementById("btnAccion").innerHTML = "Eliminar usuario";
    //alert(id);
    Swal.fire(
        {
            title: 'Estas seguro?',
            text: "Esta acción no se podra revertir!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Eliminar',
            cancelButtonText: 'No eliminar'
        }
    ).then((result) =>
        {
            if (result.isConfirmed)
            {
                //Se asigna la url a la variable mas el controlador
                //Se llama al metodo editar del archivo usuarios.php
                const url = base_url + "Clientes/eliminar/" + id;
                /*XMLHttpRequest es un objeto JavaScript que fue diseñado por Microsoft y adoptado por Mozilla,
                Apple y Google. Actualmente es un estándar de la W3C. Proporciona una forma fácil de obtener
                información de una URL sin tener que recargar la página completa*/
                //Se instancia el objeto XMLHttpRequest
                const http = new XMLHttpRequest();
                //Se abre una conexion por el metodo POST y se envia una URL como parametro y se indica que se va a ejecutar
                //de forma asincrona mediante el true
                http.open("GET", url, true);
                //Se realiza el envio de la peticion
                http.send();
                //Se va a verificar el estado
                http.onreadystatechange = function()
                {
                    //si readyState == 4 y status == 200 significa que la respuesta esta lista
                    if (this.readyState == 4 && this.status == 200)
                    {                            
                        //Se almacena en la constante res la respuesta del servidor
                        const res = JSON.parse(this.responseText);
                        //console.log(this.responseText);
                        if (res == "ok")
                        {
                            Swal.fire(
                                'Eliminar!',
                                'Cliente eliminado con éxito',
                                'success'
                                )
                                tblClientes.ajax.reload();
                        }else{
                            Swal.fire(
                                'Mensaje de error!',
                                res,
                                'error'
                                )
                        }
                    }
                }
            }
        }
    )
}

function btnReingresarCli(id)
{
    //document.getElementById("title").innerHTML = "Eliminar usuario";
    //document.getElementById("btnAccion").innerHTML = "Eliminar usuario";
    //alert(id);
    Swal.fire(
        {
            title: 'Estas seguro de activar?',
            //text: "Esta acción no se podra revertir!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Activar',
            cancelButtonText: 'No activar'
        }
    ).then((result) =>
        {
            if (result.isConfirmed)
            {
                //Se asigna la url a la variable mas el controlador
                //Se llama al metodo editar del archivo usuarios.php
                const url = base_url + "Clientes/reingresar/"+id;
                /*XMLHttpRequest es un objeto JavaScript que fue diseñado por Microsoft y adoptado por Mozilla,
                Apple y Google. Actualmente es un estándar de la W3C. Proporciona una forma fácil de obtener
                información de una URL sin tener que recargar la página completa*/
                //Se instancia el objeto XMLHttpRequest
                const http = new XMLHttpRequest();
                //Se abre una conexion por el metodo POST y se envia una URL como parametro y se indica que se va a ejecutar
                //de forma asincrona mediante el true
                http.open("GET", url, true);
                //Se realiza el envio de la peticion
                http.send();
                //Se va a verificar el estado
                http.onreadystatechange = function()
                {
                    //si readyState == 4 y status == 200 significa que la respuesta esta lista
                    if (this.readyState == 4 && this.status == 200)
                    {                            
                        //Se almacena en la constante res la respuesta del servidor
                        const res = JSON.parse(this.responseText);
                        //console.log(this.responseText);
                        if (res == "ok")
                        {
                            Swal.fire(
                                'Mensaje!',
                                'Cliente activado con exito',
                                'success'
                                )
                                tblClientes.ajax.reload();
                        }else{
                            Swal.fire(
                                'Mensaje de error!',
                                res,
                                'error'
                                )
                        }
                    }
                }
            }
        }
    )
}

// FIN CRUD CLIENTES ///////////////////////////////////////////////////////////////////////////////////
//- - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - 
// INICIO CRUD CATEGORIAS ////////////////////////////////////////////////////////////////////////////////


function frmCategoria()
{
    document.getElementById("title").innerHTML = "Nuevo categoria";
    document.getElementById("btnAccion").innerHTML = "Registrar categoria";
    document.getElementById("frmCategoria").reset();
    $("#nuevo_categoria").modal("show");
    document.getElementById("id").value = "";
}


function registrarCat(e)
{
    //Se agrega la funciona preventDefault a la variable e para que no recargue la pagina automaticamente cuando
    //le den clic en el boton Login
    e.preventDefault();
    //Se crea la constante usuario y clave para asignarle el campo usuario de la pagina Index mediante
    //el documentgetELementById
    const id = document.getElementById("id");
    const nombre = document.getElementById("nombre");
    //console.log(nombre.value);
    //Se procede a hacer validaciones de los campos
    if (nombre.value == "")
    {
        Swal.fire(
            {
                position: 'center',
                icon: 'error',
                title: 'Todos los campos son obligatorios',
                showConfirmButton: true
                //timer: 1500
            }
        )
    }else{
        const url = base_url + "Categorias/registrar";
        const frm = document.getElementById("frmCategoria");
        const http = new XMLHttpRequest();
        http.open("POST", url, true);
        http.send(new FormData(frm));
        http.onreadystatechange = function()
        {
            if (this.readyState == 4 && this.status == 200)
            {
                //console.log("Response Text -> "+this.responseText);
                const res = JSON.parse(this.responseText);
                //console.log("Response Text Res -> "+res);
                if(res == "si")
                {
                    Swal.fire(
                        {
                            position: 'center',
                            icon: 'success',
                            title: 'Categoría registrada con exito',
                            showConfirmButton: true
                            //timer: 1500
                        }
                    )
                    frm.reset();
                    $("#nuevo_categoria").modal("hide");
                    tblCategorias.ajax.reload();
                    //Metodo para recargar la pagina automaticamente
                    //location.reload();
                }else if(res == "modificado")
                {
                    Swal.fire(
                        {
                            position: 'center',
                            icon: 'success',
                            title: 'Categoria modificada con exito',
                            showConfirmButton: true
                            //timer: 1500
                        }
                    )
                    $("#nuevo_categoria").modal("hide");
                    //Para que recargue solamente el area en donde se encuentran los registros de los usuarios
                    tblCategoria.ajax.reload();
                }else{
                    Swal.fire(
                        {
                            position: 'center',
                            icon: 'error',
                            title: res,
                            showConfirmButton: true
                            //timer: 1500
                        }
                    )
                }
            }
        }
    }
}


function btnEditarCat(id)
{
    document.getElementById("title").innerHTML = "Actualizar Categoria";
    document.getElementById("btnAccion").innerHTML = "Modificar categoria";
    //Se asigna la url a la variable mas el controlador
    //Se llama al metodo editar del archivo usuarios.php
    const url = base_url + "Categorias/editar/" + id;
    //console.log("El id es-> "+id);
    /*XMLHttpRequest es un objeto JavaScript que fue diseñado por Microsoft y adoptado por Mozilla,
    Apple y Google. Actualmente es un estándar de la W3C. Proporciona una forma fácil de obtener
    información de una URL sin tener que recargar la página completa*/
    //Se instancia el objeto XMLHttpRequest
    const http = new XMLHttpRequest();
    //Se abre una conexion por el metodo POST y se envia una URL como parametro y se indica que se va a ejecutar
    //de forma asincrona mediante el true
    http.open("GET", url, true);
    //Se realiza el envio de la peticion
    http.send();
    //Se va a verificar el estado
    http.onreadystatechange = function()
    {
        //si readyState == 4 y status == 200 significa que la respuesta esta lista
        if (this.readyState == 4 && this.status == 200)
        {
            //console.log(this.responseText);
            //Se almacena en la constante res la respuesta del servidor
            const res = JSON.parse(this.responseText);
            //console.log(res);
            document.getElementById("id").value = res.id;
            document.getElementById("nombre").value = res.nombre;
            //Le agrega una clase de bootstrap para que oculte el div claves cuando se abre el modal de
            //modificar usuario
            $("#nuevo_categoria").modal("show");
        }
    }
    
}


function btnEliminarCat(id)
{
    Swal.fire(
        {
            title: 'Estas seguro?',
            text: "Esta acción no se podra revertir!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Eliminar',
            cancelButtonText: 'No eliminar'
        }
    ).then((result) =>
        {
            if (result.isConfirmed)
            {
                //Se asigna la url a la variable mas el controlador
                //Se llama al metodo editar del archivo usuarios.php
                const url = base_url + "Categorias/eliminar/" + id;
                /*XMLHttpRequest es un objeto JavaScript que fue diseñado por Microsoft y adoptado por Mozilla,
                Apple y Google. Actualmente es un estándar de la W3C. Proporciona una forma fácil de obtener
                información de una URL sin tener que recargar la página completa*/
                //Se instancia el objeto XMLHttpRequest
                const http = new XMLHttpRequest();
                //Se abre una conexion por el metodo POST y se envia una URL como parametro y se indica que se va a ejecutar
                //de forma asincrona mediante el true
                http.open("GET", url, true);
                //Se realiza el envio de la peticion
                http.send();
                //Se va a verificar el estado
                http.onreadystatechange = function()
                {
                    //si readyState == 4 y status == 200 significa que la respuesta esta lista
                    if (this.readyState == 4 && this.status == 200)
                    {                            
                        //Se almacena en la constante res la respuesta del servidor
                        const res = JSON.parse(this.responseText);
                        //console.log(this.responseText);
                        if (res == "ok")
                        {
                            Swal.fire(
                                'Eliminar!',
                                'Categoria eliminada con éxito',
                                'success'
                                )
                                tblCategoria.ajax.reload();
                        }else{
                            Swal.fire(
                                'Mensaje de error!',
                                res,
                                'error'
                                )
                        }
                    }
                }
            }
        }
    )
}

function btnReingresarCat(id)
{
    //document.getElementById("title").innerHTML = "Eliminar usuario";
    //document.getElementById("btnAccion").innerHTML = "Eliminar usuario";
    //alert(id);
    Swal.fire(
        {
            title: 'Estas seguro de activar?',
            //text: "Esta acción no se podra revertir!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Activar',
            cancelButtonText: 'No activar'
        }
    ).then((result) =>
        {
            if (result.isConfirmed)
            {
                //Se asigna la url a la variable mas el controlador
                //Se llama al metodo editar del archivo usuarios.php
                const url = base_url + "Categorias/reingresar/"+id;
                /*XMLHttpRequest es un objeto JavaScript que fue diseñado por Microsoft y adoptado por Mozilla,
                Apple y Google. Actualmente es un estándar de la W3C. Proporciona una forma fácil de obtener
                información de una URL sin tener que recargar la página completa*/
                //Se instancia el objeto XMLHttpRequest
                const http = new XMLHttpRequest();
                //Se abre una conexion por el metodo POST y se envia una URL como parametro y se indica que se va a ejecutar
                //de forma asincrona mediante el true
                http.open("GET", url, true);
                //Se realiza el envio de la peticion
                http.send();
                //Se va a verificar el estado
                http.onreadystatechange = function()
                {
                    //si readyState == 4 y status == 200 significa que la respuesta esta lista
                    if (this.readyState == 4 && this.status == 200)
                    {                            
                        //Se almacena en la constante res la respuesta del servidor
                        const res = JSON.parse(this.responseText);
                        //console.log(this.responseText);
                        if (res == "ok")
                        {
                            Swal.fire(
                                'Mensaje!',
                                'Categoria activada con exito',
                                'success'
                                )
                                tblCategoria.ajax.reload();
                        }else{
                            Swal.fire(
                                'Mensaje de error!',
                                res,
                                'error'
                                )
                        }
                    }
                }
            }
        }
    )
}

// FIN CRUD CATEGORIAS ///////////////////////////////////////////////////////////////////////////////////
//- - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - 
// INICIO CRUD MEDIDAS ///////////////////////////////////////////////////////////////////////////////////

function frmMedidas()
{
    document.getElementById("title").innerHTML = "Nueva medida";
    document.getElementById("btnAccion").innerHTML = "Registrar medida";
    document.getElementById("frmMedidas").reset();
    $("#nuevo_medidas").modal("show");
    document.getElementById("id").value = "";
}

function registrarMed(e)
{
    e.preventDefault();
    //const id = document.getElementById("id");
    const nombre = document.getElementById("nombre");
    const nombre_corto = document.getElementById("nombre_corto");
    if(nombre.value == "" || nombre_corto.value == "") 
    {
        Swal.fire(
            {
                position: 'center',
                icon: 'error',
                title: 'Todos los campos son obligatorios',
                showConfirmButton: true
                //timer: 1500
            }
        )
    }else{
        const url = base_url + "Medidas/registrar";
        const frm = document.getElementById("frmMedidas");
        const http = new XMLHttpRequest();
        http.open("POST", url, true);
        http.send(new FormData(frm));
        http.onreadystatechange = function()
        {
            //si readyState == 4 y status == 200 significa que la respuesta esta lista
            if (this.readyState == 4 && this.status == 200)
            {
                const res = JSON.parse(this.responseText);
                //console.log("Funciones despues parse "+res);
                if(res == "si")
                {
                    Swal.fire(
                        {
                            position: 'center',
                            icon: 'success',
                            title: 'Medida registrada con exito',
                            showConfirmButton: true
                            //timer: 1500
                        }
                    )
                    frm.reset();
                    $("#nuevo_medidas").modal("hide");
                    tblMedidas.ajax.reload();
                    //Metodo para recargar la pagina automaticamente
                    //location.reload();
                }else if(res == "modificado")
                {
                    Swal.fire(
                        {
                            position: 'center',
                            icon: 'success',
                            title: 'Medida modificada con exito',
                            showConfirmButton: true
                            //timer: 1500
                        }
                    )
                    //Oculta el modal de nuevo_usuario
                    $("#nuevo_medidas").modal("hide");
                    //Para que recargue solamente el area en donde se encuentran los registros de los usuarios
                    tblMedidas.ajax.reload();
                }else{
                    Swal.fire(
                        {
                            position: 'center',
                            icon: 'error',
                            title: res,
                            showConfirmButton: true
                            //timer: 1500
                        }
                    )
                }
            }
        }
    }
}



function btnEditarMed(id)
{
    document.getElementById("title").innerHTML = "Actualizar medida";
    document.getElementById("btnAccion").innerHTML = "Modificar medida";
    const url = base_url + "Medidas/editar/" +id;
    const http = new XMLHttpRequest();
    http.open("GET", url, true);
    http.send();
    http.onreadystatechange = function()
    {
        if (this.readyState == 4 && this.status == 200)
        {
            const res = JSON.parse(this.responseText);
            //console.log("Function btnEditarMed-> "+id);
            document.getElementById("id").value = res.id;
            document.getElementById("nombre").value = res.nombre;
            document.getElementById("nombre_corto").value = res.nombre_corto;
            $("#nuevo_medidas").modal("show");
        }
    }
}

function btnEliminarMed(id)
{
    Swal.fire(
        {
            title: 'Estas seguro?',
            text: "Esta acción no se podra revertir!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Eliminar',
            cancelButtonText: 'No eliminar'
        }
    ).then((result) =>
        {
            if (result.isConfirmed)
            {
                //Se asigna la url a la variable mas el controlador
                //Se llama al metodo editar del archivo usuarios.php
                const url = base_url + "Medidas/eliminar/" + id;
                /*XMLHttpRequest es un objeto JavaScript que fue diseñado por Microsoft y adoptado por Mozilla,
                Apple y Google. Actualmente es un estándar de la W3C. Proporciona una forma fácil de obtener
                información de una URL sin tener que recargar la página completa*/
                //Se instancia el objeto XMLHttpRequest
                const http = new XMLHttpRequest();
                //Se abre una conexion por el metodo POST y se envia una URL como parametro y se indica que se va a ejecutar
                //de forma asincrona mediante el true
                http.open("GET", url, true);
                //Se realiza el envio de la peticion
                http.send();
                //Se va a verificar el estado
                http.onreadystatechange = function()
                {
                    //si readyState == 4 y status == 200 significa que la respuesta esta lista
                    if (this.readyState == 4 && this.status == 200)
                    {                            
                        //Se almacena en la constante res la respuesta del servidor
                        const res = JSON.parse(this.responseText);
                        //console.log(this.responseText);
                        if (res == "ok")
                        {
                            Swal.fire(
                                'Eliminar!',
                                'Medida eliminada con éxito',
                                'success'
                                )
                                tblMedidas.ajax.reload();
                        }else{
                            Swal.fire(
                                'Mensaje de error!',
                                res,
                                'error'
                                )
                        }
                    }
                }
            }
        }
    )
}

function btnReingresarMed(id)
{
    //document.getElementById("title").innerHTML = "Eliminar usuario";
    //document.getElementById("btnAccion").innerHTML = "Eliminar usuario";
    //alert(id);
    Swal.fire(
        {
            title: 'Estas seguro de activar?',
            //text: "Esta acción no se podra revertir!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Activar',
            cancelButtonText: 'No activar'
        }
    ).then((result) =>
        {
            if (result.isConfirmed)
            {
                //Se asigna la url a la variable mas el controlador
                //Se llama al metodo editar del archivo usuarios.php
                const url = base_url + "Medidas/reingresar/" + id;
                /*XMLHttpRequest es un objeto JavaScript que fue diseñado por Microsoft y adoptado por Mozilla,
                Apple y Google. Actualmente es un estándar de la W3C. Proporciona una forma fácil de obtener
                información de una URL sin tener que recargar la página completa*/
                //Se instancia el objeto XMLHttpRequest
                const http = new XMLHttpRequest();
                //Se abre una conexion por el metodo POST y se envia una URL como parametro y se indica que se va a ejecutar
                //de forma asincrona mediante el true
                http.open("GET", url, true);
                //Se realiza el envio de la peticion
                http.send();
                //Se va a verificar el estado
                http.onreadystatechange = function()
                {
                    //si readyState == 4 y status == 200 significa que la respuesta esta lista
                    if (this.readyState == 4 && this.status == 200)
                    {                            
                        //Se almacena en la constante res la respuesta del servidor
                        const res = JSON.parse(this.responseText);
                        //console.log(this.responseText);
                        if (res == "ok")
                        {
                            Swal.fire(
                                'Mensaje!',
                                'Medida activada con exito',
                                'success'
                                )
                                tblMedidas.ajax.reload();
                        }else{
                            Swal.fire(
                                'Mensaje de error!',
                                res,
                                'error'
                                )
                        }
                    }
                }
            }
        }
    )
}

// FIN CRUD MEDIDAS ///////////////////////////////////////////////////////////////////////////////////
//- - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - 
// INICIO CRUD PRODUCTOS ///////////////////////////////////////////////////////////////////////////////////

//Funcion que se ejecutara cuando se presion el boton Nuevo usuario del index
function frmProducto()
{
    document.getElementById("title").innerHTML = "Nuevo producto";
    document.getElementById("btnAccion").innerHTML = "Registrar producto";
    document.getElementById("frmProducto").reset();
    document.getElementById("id").value = "";
    $("#nuevo_producto").modal("show");
    deleteImg();
}


//Esta funcion se ejecutara cuando se presione el boton Registrar del modal nuevo usuario
function registrarPro(e)
{
    e.preventDefault();
    const codigo = document.getElementById("codigo");
    const nombre = document.getElementById("nombre");
    const precio_compra = document.getElementById("precio_compra");
    const precio_venta = document.getElementById("precio_venta");
    const cantidad = document.getElementById("cantidad");
    const medida = document.getElementById("medida");
    const categoria = document.getElementById("categoria");
    const id = document.getElementById("id");
    if (codigo.value=="" || nombre.value=="" || precio_compra.value=="" || precio_venta.value=="" || cantidad.value=="" || medida.value=="" || categoria.value=="")
    {
        Swal.fire(
            {
                position: 'center',
                icon: 'error',
                title: 'Todos los campos son obligatorios',
                showConfirmButton: false,
                timer: 1500
            }
        )
    }else{
        const url = base_url + "Productos/registrar";
        const frm = document.getElementById("frmProducto");
        const http = new XMLHttpRequest();
        http.open("POST", url, true);
        http.send(new FormData(frm));
        http.onreadystatechange = function()
        {
            if (this.readyState == 4 && this.status == 200)
            {
                //console.log(this.responseText);
                const res = JSON.parse(this.responseText);
                //console.log("registrarUser"+" "+res);
                if(res == "si")
                {
                    Swal.fire(
                        {
                            position: 'center',
                            icon: 'success',
                            title: 'Producto registrado con exito',
                            showConfirmButton: false,
                            timer: 1500
                        }
                    )
                    frm.reset();
                    $("#nuevo_producto").modal("hide");
                    tblProductos.ajax.reload();
                }else if(res == "modificado")
                {
                    Swal.fire(
                        {
                            position: 'center',
                            icon: 'success',
                            title: 'Producto modificado con exito',
                            showConfirmButton: false,
                            timer: 1500
                        }
                    )
                    $("#nuevo_producto").modal("hide");
                    tblProductos.ajax.reload();
                }else{
                    Swal.fire(
                        {
                            position: 'center',
                            icon: 'error',
                            title: res,
                            showConfirmButton: false,
                            timer: 1500
                        }
                    )
                }
            }
        }
    }
}



function btnEditarProducto(id)
{
    document.getElementById("title").innerHTML = "Actualizar Producto";
    document.getElementById("btnAccion").innerHTML = "Modificar Producto";
    const url = base_url + "Productos/editar/"+id;
    const http = new XMLHttpRequest();
    http.open("GET", url, true);
    http.send();
    http.onreadystatechange = function()
    {
        if (this.readyState == 4 && this.status == 200)
        {
            //console.log(this.responseText);
            const res = JSON.parse(this.responseText);
            //console.log(res);
            document.getElementById("id").value = res.id;
            document.getElementById("codigo").value = res.codigo;
            document.getElementById("nombre").value = res.descripcion;
            document.getElementById("precio_compra").value = res.precio_compra;
            document.getElementById("precio_venta").value = res.precio_venta;
            document.getElementById("cantidad").value = res.cantidad;
            document.getElementById("medida").value = res.id_medida;
            document.getElementById("categoria").value = res.id_categoria;
            //Se agrega sentencia para que cargue la imagen del producto cuando se le de editar
            document.getElementById("img-preview").src = base_url+'Assets/img/'+res.foto;
            //Agrega el boton de eliminar imagen
            document.getElementById("icon-cerrar").innerHTML= `
            <button class="btn btn-danger mb-2" onclick="deleteImg()">
            <i class="fas fa-times mr-2"></i>Eliminar imagen</button>`;
            document.getElementById("icon-image").classList.add("d-none");
            //Se obtiene los dos input tipo hidden
            document.getElementById("foto_actual").value = res.foto;
            //document.getElementById("foto_delete").value = res.foto;
            $("#nuevo_producto").modal("show");
        }
    }
}


function btnEliminarProducto(id)
{
    Swal.fire(
        {
            title: 'Estas seguro?',
            text: "Esta acción no se podra revertir!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Eliminar',
            cancelButtonText: 'No eliminar'
        }
    ).then((result) =>
        {
            if (result.isConfirmed)
            {
                //Se asigna la url a la variable mas el controlador
                //Se llama al metodo editar del archivo usuarios.php
                const url = base_url + "Productos/eliminar/"+id;
                /*XMLHttpRequest es un objeto JavaScript que fue diseñado por Microsoft y adoptado por Mozilla,
                Apple y Google. Actualmente es un estándar de la W3C. Proporciona una forma fácil de obtener
                información de una URL sin tener que recargar la página completa*/
                //Se instancia el objeto XMLHttpRequest
                const http = new XMLHttpRequest();
                //Se abre una conexion por el metodo POST y se envia una URL como parametro y se indica que se va a ejecutar
                //de forma asincrona mediante el true
                http.open("GET", url, true);
                //Se realiza el envio de la peticion
                http.send();
                //Se va a verificar el estado
                http.onreadystatechange = function()
                {
                    //si readyState == 4 y status == 200 significa que la respuesta esta lista
                    if (this.readyState == 4 && this.status == 200)
                    {                            
                        //Se almacena en la constante res la respuesta del servidor
                        const res = JSON.parse(this.responseText);
                        //console.log(this.responseText);
                        if (res == "ok")
                        {
                            Swal.fire(
                                'Eliminar!',
                                'Ha sido eliminado',
                                'success'
                                )
                                tblProductos.ajax.reload();
                        }else{
                            Swal.fire(
                                'Mensaje de error!',
                                res,
                                'error'
                                )
                        }
                    }
                }
            }
        }
    )
}


function btnReingresarProducto(id)
{
    Swal.fire(
        {
            title: 'Estas seguro de activar?',
            text: "Esta acción no se podra revertir!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Activar',
            cancelButtonText: 'No activar'
        }
    ).then((result) =>
        {
            if (result.isConfirmed)
            {
                const url = base_url + "Productos/reingresar/"+id;
                const http = new XMLHttpRequest();
                http.open("GET", url, true);
                http.send();
                http.onreadystatechange = function()
                {
                    if (this.readyState == 4 && this.status == 200)
                    {
                        const res = JSON.parse(this.responseText);
                        //console.log(this.responseText);
                        if (res == "ok")
                        {
                            Swal.fire(
                                'Mensaje!',
                                'Usuario activado con exito',
                                'success'
                                )
                                tblProductos.ajax.reload();
                        }else{
                            Swal.fire(
                                'Mensaje de error!',
                                res,
                                'error'
                                )
                        }
                    }
                }
            }
        }
    )
}


//Funcion que se ejecuta cuando el usuario da clic en el boton "Agregar imagen"
function preview(e)
{
    //target.files obtiene todos los datos del archivo
    //console.log(e.target.files);
    //Se almacenan los datos del archivo en la variable url
    const url = e.target.files[0];
    /*El método estático URL.createObjectURL() crea un DOMString que contiene una URL que
    representa al objeto pasado como parámetro. La vida de la URL está ligado al document
    de la ventana en la que fue creada. El nuevo objeto URL representa al objeto File
    especificado o al objeto Blob*/
    const urltemp = URL.createObjectURL(url);
    document.getElementById("img-preview").src = urltemp;
    //Se agrega la clase display-none al boton icon-image
    document.getElementById("icon-image").classList.add("d-none");
    //Agrega el boton de eliminar imagen
    document.getElementById("icon-cerrar").innerHTML= `
    <button class="btn btn-danger mb-2" onclick="deleteImg()"><i class="fas fa-times mr-2"></i>Eliminar imagen</button>
    ${url['name']};
    `
}


//Funcion que elimina la imagen
function deleteImg()
{
    document.getElementById("icon-cerrar").innerHTML = '';
    document.getElementById("icon-image").classList.remove("d-none");
    document.getElementById("img-preview").src = '';
    document.getElementById("imagen").value = '';
    document.getElementById("foto_actual").value = '';
}


// FIN CRUD PRODUCTOS ///////////////////////////////////////////////////////////////////////////////////
//- - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - 
// INICIO FUNCIONES DE COMPRAS///////////////////////////////////////////////////////////////////////////


function buscarCodigo(e)
{
    e.preventDefault();
    //condicion para validar que se capture cuando se presione la tecla Enter
    if(e.which == 13)
    {
        const cod = document.getElementById("codigo").value;
        const url = base_url + "Compras/buscarCodigo/"+cod;
        const http = new XMLHttpRequest();
        http.open("GET", url, true);
        http.send();
        http.onreadystatechange = function()
        {
            if (this.readyState == 4 && this.status == 200)
            {
                //console.log(this.responseText);
                const res = JSON.parse(this.responseText);
                if(res)
                {
                    document.getElementById("nombre").value = res.descripcion;
                    document.getElementById("precio").value = res.precio_venta;
                    document.getElementById("id").value = res.id;
                    document.getElementById("cantidad").focus();
                }else{
                    Swal.fire(
                        {
                            position: 'center',
                            icon: 'error',
                            title: 'El producto no existe',
                            text: "Por favor verifique el código",
                            showConfirmButton: false,
                            timer: 1000
                        }
                    )
                    document.getElementById("codigo").value = '';
                    document.getElementById("codigo").focus();
                }
            }
        }
    }
    
}


function calcularPrecio(e)
{
    e.preventDefault();
    const cant = document.getElementById("cantidad").value;
    const precio = document.getElementById("precio").value;
    document.getElementById("sub_total").value = cant*precio;
    if(e.which == 13)
    {
        //console.log("Ha presionado Enter");
        if (cant > 0)
        {
            const url = base_url + "Compras/ingresar";
            const frm = document.getElementById("frmCompra");
            const http = new XMLHttpRequest();
            http.open("POST", url, true);
            http.send(new FormData(frm));
            http.onreadystatechange = function()
            {
                if (this.readyState == 4 && this.status == 200)
                {
                    //console.log(this.responseText);
                    const res = JSON.parse(this.responseText);
                    //console.log(res);
                    if(res == "Ok")
                    {
                        //alert('Ingresado');
                        Swal.fire(
                            {
                                position: 'center',
                                icon: 'success',
                                title: 'Producto ingresado con éxito',
                                showConfirmButton: false,
                                timer: 1000
                            }
                        )
                        frm.reset();
                        cargarDetalle();
                        document.getElementById("codigo").focus();
                    }else if(res == 'modificado'){
                        //alert('modificado');
                        Swal.fire(
                            {
                                position: 'center',
                                icon: 'success',
                                title: 'Producto añadido con éxito',
                                //showConfirmButton: true
                                timer: 1000
                            }
                        )
                        frm.reset();
                        cargarDetalle();
                        document.getElementById("codigo").focus();
                    }
                }
            }
        }
    }
}

/*
Funcion para detectar si existe algo en la tabla Detalle de la pagina compras,
en caso de haber algo, llamar a la funcion cargarDetalle()
*/
if(document.getElementById('tblDetalle'))
{
    cargarDetalle();
}


function cargarDetalle()
{
    const url = base_url + "Compras/listar";
    const http = new XMLHttpRequest();
    http.open("GET", url, true);
    http.send();
    http.onreadystatechange = function()
    {
        if (this.readyState == 4 && this.status == 200)
        {
            //console.log(this.responseText);
            const res = JSON.parse(this.responseText);
            let html = '';
            //res['detalle'].forEach(row => {
            res.detalle.forEach(row => {//Otra forma de hacerlo diferente a la anterior
                html += `
                    <tr>
                        <td>${row['id']}</td>
                        <td>${row['descripcion']}</td>
                        <td>${row['cantidad']}</td>
                        <td>${row['precio']}</td>
                        <td>${row['sub_total']}</td>
                        <td>
                            <button class="btn btn-danger" type="button" onclick="deleteDetalle(${row['id']})"><i class="fas fa-trash-alt"></i></button>
                        </td>
                    </tr>
                `
            });
            document.getElementById("tblDetalle").innerHTML = html;
            //document.getElementById("total").value = res['sub_total'].total;
            document.getElementById("total").value = res.sub_total.total;//Otra forma de hacerlo diferente a la anterior
        }
    }
}


function deleteDetalle(id)
{
    //alert(id);
    const url = base_url + "Compras/delete/"+id;
    const http = new XMLHttpRequest();
    http.open("GET", url, true);
    http.send();
    http.onreadystatechange = function()
    {
        if (this.readyState == 4 && this.status == 200)
        {
            //console.log(this.responseText)
            const res = JSON.parse(this.responseText);
            if (res == 'ok')
            {
                Swal.fire(
                {
                    position: 'center',
                    icon: 'success',
                    title: 'Producto eliminado con exito',
                    showConfirmButton: true
                })
                cargarDetalle();
            }else{
                Swal.fire(
                'Mensaje de error!',
                res,
                'error'
                )
            }
        }
    }
}

function generarCompra()
{
    Swal.fire(
        {
            title: 'Estas seguro de realizar compra?',
            //text: "Esta acción no se podra revertir!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Confirmar comprar',
            cancelButtonText: 'Cancelar compra'
        }
    ).then((result) =>
        {
            if (result.isConfirmed)
            {
                const url = base_url + "Compras/registrarCompra";
                const http = new XMLHttpRequest();
                http.open("GET", url, true);
                http.send();
                http.onreadystatechange = function()
                {
                    if (this.readyState == 4 && this.status == 200)
                    {
                        const res = JSON.parse(this.responseText);
                        //console.log(this.responseText);
                        if (res.msg == "ok")
                        {
                            Swal.fire(
                                'Mensaje!',
                                'Compra realizada con éxito',
                                'success'
                                )
                                const ruta = base_url+'Compras/generarPdf/'+res.id_compra;
                                window.open(ruta);
                                setTimeout(() => {
                                    window.location.reload();
                                }, 150);
                        }else{
                            Swal.fire(
                                'Mensaje de error!',
                                res,
                                'error'
                                )
                        }
                    }
                }
            }
        }
    )
}

// FIN FUNCIONES DE COMPRAS///////////////////////////////////////////////////////////////////////////
//- - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - 
// INICIO FUNCIONES DE DATOS DE EMPRESA///////////////////////////////////////////////////////////////////////////

function modificarEmpresa()
{
    const url = base_url + "Administracion/modificar";
    const frm = document.getElementById("frmEmpresa");
    const http = new XMLHttpRequest();
    http.open("POST", url, true);
    http.send(new FormData(frm));
    http.onreadystatechange = function()
    {
        if (this.readyState == 4 && this.status == 200)
        {
            //console.log(this.responseText);
            const res = JSON.parse(this.responseText);
            //console.log(this.responseText);
            if(res == 'ok')
            {
                //console.log('Modificado');
                Swal.fire(
                    {
                        position: 'center',
                        icon: 'success',
                        title: 'Producto registrado con exito',
                        showConfirmButton: false,
                        timer: 1000
                    })
            }else{
                //console.log('Pailas');
                Swal.fire(
                    {
                        position: 'center',
                        icon: 'error',
                        title: res,
                        showConfirmButton: false,
                        timer: 1000
                    })
            }
        }
    }
}

