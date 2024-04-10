<?php
    //Se crea la clase con el mismo nombre que el archivo
    class Conexion
    {
        //Se crea variable privada conect
        private $conect;
        //Se crea el constructor
        public function __construct()
        {
            //Se realiza concatenado de las constantes que se encuentran en el archivo Config.php
            $pdo = "pgsql:host=".host.";dbname=".db;
            //Se crea el try - catch para capturar las excepciones
            try {
                //Se procede a utilizar el metodo conect
                $this->conect = new PDO($pdo, user, pass);
                //Se indica el atributo para capturar las excepciones
                $this->conect->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            } catch (PDOException $e) {
                //En caso de error obtenga el mensaje de error y muestrelo
                echo "Error en la conexion".$e->getMessage();
            }
        }
        public function conect()
        {
            return $this->conect;
        }
    }
?>