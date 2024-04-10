<?php
    //Desde aqui es desde donde se va a comenzar a ejecutar todo lo del archivo Controller.php
    //Se ejecuta una funcion y como parametro se le envia una variable con nombre clase

    //La función spl_autoload_register() permite evitar incluir manualmente todas las clases
    //al principio de cada página PHP. Esta función toma como parámetro su función permitiendo incluir las clases necesarias.

    //El metodo spl_autoload_register será llamado desde el index.php
    //echo "Se ejecuto autoload";
    spl_autoload_register(function($class)
    {
        //Se verifica si el archivo existe
        if(file_exists("Config/App/".$class.".php"))
        {
            //Si existe el archivo, se requiere
            require_once "Config/App/".$class.".php";
        }
    }
    )
?>