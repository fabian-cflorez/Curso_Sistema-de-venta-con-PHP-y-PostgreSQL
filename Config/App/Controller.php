<?php
    //Este archivo Controller.php será el que conecte el controlador con el modelo y con la vista
   // echo "Se ejecuto controller";
    class Controller
    {
        protected $views, $model;
        //De ultimo se crea este constructor ques es el llama automaticamente al metodo cargarModel()
        public function __construct()
        {
            //Se llama a ejecutar la vista de Config/App
            $this->views = new Views();
            //Se llama a ejecutar la funcion cargarModel
            $this->cargarModel();
        }
        //Funcion que cargara al modelo
        function cargarModel()
        {
            //Se crea la variable $model para que se almacene las clases de los archivos dentro de la carpeta Models
            //Todos los archivos deben terminar en Model para que funciones -> pruebaModel.php
            $model = get_Class($this)."Model";
            //Una vez se tiene el modelo, entonces se configura para que se almacene la ruta de la clase dentro del
            //archivo y se almacena en la variable $ruta
            $ruta = "Models/".$model.".php";
            //Se verifica si existe la ruta
            if(file_exists($ruta))
            {
                //Si existe la ruta, entonces se requiere
                require_once $ruta;
                $this->model = new $model();
            }
        }
    }
    //Para crear automaticamente este controlador, se crea el archivo Autoload.php
?>