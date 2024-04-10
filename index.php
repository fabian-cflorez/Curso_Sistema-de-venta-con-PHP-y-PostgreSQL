<?php

    //Se esta requiriendo el archivo config.php que es el posee la url base
    require_once "Config/Config.php";
//Se almacena en la variable ruta la validacion de existencia de la url
//empty valida si algo esta vacío o no, entonces la sentencia indica que si la url no esta vacía, caso contrario (?) obtenga esa ruta
//
    $ruta = !empty($_GET['url']) ? $_GET['url'] : "Home/index";
    //echo $ruta;
    // se almacena en un array toda la ruta y se indica que se divida por el /
    $array = explode("/", $ruta);
    //print_r($array);
    $controller = $array[0];
    $metodo = "index";
    $parametro = "";
    if(!empty($array[1]))
    {
        if(!empty($array[1] != ""))
        {
            $metodo = $array[1];
        }
    }
    //print_r($metodo);
    if(!empty($array[2]))
    {
        if(!empty($array[2] != ""))
        {
            for($i=2; $i < count($array); $i++)
            {
                $parametro .= $array [$i]. ",";
            }
            //el metodo trim elimina el ultimo caracter de una frase, en este caso elimina la ultima coma (,)
            $parametro = trim($parametro, ",");
        }
    }
    //echo $controller;
    //echo $metodo;
    //echo $parametro;

    //Se realiza requerimiento del archivo Autoload.php
    require_once "Config/App/Autoload.php";

    //Se crea la variable dirController que es en donde estará el archivo php
    $dirController = "Controllers/".$controller.".php";
    //Se valida que el directorio exista
    if(file_exists($dirController))
    {
        //Si existe, se requiere.
        require_once $dirController;
        //Se crea una instancia de la clase
        $controller = new $controller();
        //Ahora se valida que exista un metodo, si existe en recibe como parametro el controlador y el metodo
        if(method_exists($controller, $metodo))
        {
            //Si existe, entonces controller es igual al metodo y recibe un parametro
            $controller->$metodo($parametro);
        }
        else
        {
            echo "No existe el metodo";
        }
    }
    else
    {
        echo "No existe el controlador";
    }

?>