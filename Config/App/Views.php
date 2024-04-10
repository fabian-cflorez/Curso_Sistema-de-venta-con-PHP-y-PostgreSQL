<?php
    //Este archivo va a conectar las vistas con el controlador
    class Views
    {
        //Se crea la clase getView que recibe como parametros a $controlador y a $vista
        //Luego se agrega $data y se inicializa como vacio para que muestre las opciones de cajas
        //en el modal de Nuevo Usuario
        public function getView($controlador, $vista, $data="")
        {
            //Se obtiene la clase del controlador
            $controlador = get_Class($controlador);
            //Se valida si el controlador es igual a Home
            if($controlador == "Home")
            {
                //Si es igual a Home entonces la vista es igual a la siguiente ruta
                $vista = "Views/".$vista.".php";
            }
            //En caso que no sea así, entonces la ruta sera la siguiente
            else{
                $vista = "Views/".$controlador."/".$vista.".php";
            }
            //Se requiere la vista
            require_once $vista;
        }
    }
?>