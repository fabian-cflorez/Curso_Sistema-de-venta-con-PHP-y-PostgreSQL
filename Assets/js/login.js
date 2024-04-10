function frmLogin(e)
{
    //La funciones frmlogin se ejecuta cuando el usuario le da clic en el boton Login de la pagina de index
    //Se agrega la funciona preventDefault a la variable e para que no recargue la pagina automaticamente cuando
    //le den clic en el boton Login
    e.preventDefault();
    //Se crea la constante usuario y clave para asignarle el campo usuario de la pagina Index mediante
    //el documentgetELementById
    const usuario = document.getElementById("usuario");
    const clave = document.getElementById("clave");
    //Se procede a hacer validaciones de los campos
    if (usuario.value == "")
    {
        clave.classList.remove("#is-invalid");
        usuario.classList.add("is-invalid");
        usuario.focus();
    }else if(clave.value == ""){
        usuario.classList.remove("is-invalid");
        clave.classList.add("is-invalid");
        clave.focus();
    }else{
        //Se asigna la url a la variable mas
        const url = base_url + "Usuarios/validar";
        //Se obtiene el id frmlogin del index
        const frm = document.getElementById("frmlogin");
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
                //console.log (this.responseText);
                const res = JSON.parse(this.responseText);
                //console.log (res);
                //Se va a validar la respuesta obtenida en la validacion realizada en usuarios.php
                if(res == "Ok")
                {
                    //En caso de que la respuesta sea Ok, entonces va a ejecutar el controlador usuario ya que por
                    //defecto ejecutara el metodo index index
                    window.location = base_url + "Usuarios";
                }else{
                    //Se quita la clase del mensaje alerta del index.php
                    document.getElementById("alerta").classList.remove("d-none");
                    //En caso de que no sean las credenciales correctas, entonces se agrega
                    //un mensaje de usuario o contraseña incorrecta
                    document.getElementById("alerta").innerHTML = res;
                }
                //console.log(this.responseText);
            }
        }
    }
}