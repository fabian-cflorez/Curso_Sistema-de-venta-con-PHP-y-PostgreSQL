<?php

    //Clase llamada desde el index.php
    class Home extends Controller
    {

        public function __construct()
        {
            session_start();
            if(!empty($_SESSION['activo']))
            {
                header("location:".base_url."Usuarios");
            }

            parent::__construct();
        }


        //Metodo llamado desde el index.php
        public function index()
        {
           // echo "Funciona el metodo";
            $this->views->getView($this, "index");
        }
    }

?>