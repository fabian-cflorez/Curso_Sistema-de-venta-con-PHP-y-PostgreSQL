<?php
    //Se crea la clase con el mismo nombre de archivo y hereda de Conexion.php
    class Query extends Conexion
    {
        private $pdo, $con, $sql, $datos;
        public function __construct()
        {
            //Se realiza instancia de la clase conecion
            $this->pdo = new conexion();
            //La instancia se la vamos a pasar a la variable con y luego se accede a su metodo conect
            $this->con = $this->pdo->conect();
        }
        //Se crea la funcion select y se envia como parametro un string sql
        public function select(string $sql)
        {
            //Se accede a la variable sql y se iguala con lo que se esta pasando como parametro sql
            $this->sql = $sql;
            //Se prepara la consulta
            $resul = $this->con->prepare($this->sql);
            //Se ejecuta la consulta
            $resul->execute();
            //Se procede a obtener un registro de la base de datos (a manera de prueba)
            $data = $resul->fetch(PDO::FETCH_ASSOC);
            //Se retorna el resultado
            return $data;
        }
        //Se crea esta funcion para consultar todos los usuarios existentes en la bd
        public function selectAll(string $sql)
        {
            //print("SelectAll");
            //Se accede a la variable sql y se iguala con lo que se esta pasando como parametro sql
            $this->sql = $sql;
            //Se prepara la consulta
            $resul = $this->con->prepare($this->sql);
            //Se ejecuta la consulta
            $resul->execute();
            //Se procede a obtener todos los registros de la base de datos, se cambia el fetch por fetchAll
            $data = $resul->fetchAll(PDO::FETCH_ASSOC);
            //Se retorna el resultado
            //print_r($data);
            return $data;
        }

        
        //Se crea la funcion para registrar los datos, los parametros vienen de la funcion registrarUsuarios
        //del archivo UsuariosModel
        //Esta funcion sera ejecutada desde la funcion registrarUsuarios del archivo UsuariosModel
        public function save(string $sql, array $datos)
        {
            //Se iguala la variable sql con el parametro sql recibido
            $this->sql = $sql;
            //Se iguala la variable datos con el parametro datos recibido
            $this->datos = $datos;
            //se prepara la conexion
            $insert = $this->con->prepare($this->sql);
            //Se ejecuta la conexion
            $data = $insert->execute($this->datos); 
            //se valida si la data se insertó correctamente
            //La respuesta res es recibida por las funciones del controlador Usuarios
            if($data)
            {
                $res = 1;
            }else{
                $res = 0;
            }
            return $res;
        }
    }
?>