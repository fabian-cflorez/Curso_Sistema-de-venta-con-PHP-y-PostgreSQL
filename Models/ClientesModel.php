<?php
    //Se crea la clase con el mismo nombre del archivo y se hereda de la clase Query
    class ClientesModel extends Query
    {
        //Se establecen como privadas las variables que vienen desde el modal registrarUsuario
        private $dni, $nombre, $telefono, $direccion, $estado;

        public function __construct()
        {
            parent::__construct();
        }


        public function getClientes()
        {
            //Se le asigna un string a la variable sql, ese string es la consulta que va a recibir como parametro
            //la funcion select del archivo Query.php
            //$sql = "SELECT * FROM usuarios";
            $sql = "SELECT * FROM clientes";
            //select devuelve solo un resultado de la consulta
            $data = $this->selectAll($sql);
            return $data;
        }
        

        //Se crea la funcion registrarUsuarios para que se comunique con la bd e inserte los datos
        //Esta funcion sera llamada desde la funcion registrar de Usuarios.php
        public function registrarCliente(string $dni, string $nombre, string $telefono, string $direccion)
        {
            //Igualamos la variable dni con el parametro $dni y así con cada variable y parametro
            $this->dni = $dni;
            $this->nombre = $nombre;
            $this->telefono = $telefono;
            $this->direccion = $direccion;
            //Se crea la variable existe para crear una consulta a la tabla usuarios
            //para saber si ya existe el dni que se esta tratando de ingresar
            $verificar = "SELECT * FROM clientes WHERE dni='$this->dni'";
            $existe = $this->select($verificar);
            if(empty($existe))
            {
                //se configura la sentencia inserto into
                $sql = "INSERT INTO clientes(dni, nombre, telefono, direccion) VALUES(?,?,?,?)";
                //Se crea un array con los datos
                //tanto sql como array seran enviados como parametros de la funcion save del archivo query
                $datos = array($this->dni, $this->nombre, $this->telefono, $this->direccion);
                //Se hace la llamada de la funcion save y se le hace el envio de los parametros sql y datos
                $data = $this->save($sql, $datos);
                if ($data == 1)
                {
                    $res = "Ok";
                }else{
                    $res = "Error";
                }
            }else{
                $res = "existe";
            }
            return $res;
        }


        public function modificarCliente(string $dni, string $nombre, string $telefono, string $direccion, int $id)
        {
            //Igualamos la variable dni con el parametro $dni y así con cada variable y parametro
            $this->dni = $dni;
            $this->nombre = $nombre;
            $this->telefono = $telefono;
            $this->id = $id;
            $this->direccion = $direccion;
            $sql = "UPDATE clientes SET dni = ?, nombre = ?, telefono = ?, direccion = ? WHERE id = ?";
            $datos = array($this->dni, $this->nombre, $this->telefono, $this->direccion, $this->id);
            $data = $this->save($sql, $datos);
            if($data == 1)
            {
                $res = "modificado";
            }else{
                $res = "error al modificar";
            }
            return $res;
        }


        //Funcion que se llama desde Usuarios.php
        public function editarCli($id)
        {
            $sql = "SELECT * FROM clientes WHERE id = $id";
            $data = $this->select($sql);
            return $data;
        }

/*
        Este metodo sera reemplazado por accionUser la cual contendra metodos para eliminar como para activar usuarios
        Este metodo queda de backup
        public function eliminarUser($id)
        {
            $this->id = $id;
            $sql = "UPDATE usuarios SET estado = 0 WHERE id = ?";
            $datos = array($this->id);
            $data = $this->save($sql, $datos);
            return $data;
        }
*/


        //Funcion que inactiva o activa a un dni, recibe como parametro un estado y el id del dni
        public function accionCli(int $estado, int $id)
        {
            $this->id = $id;
            $this->estado = $estado;
            $sql = "UPDATE clientes SET estado = ? WHERE id = ?";
            $datos = array($this->estado, $this->id);
            $data = $this->save($sql, $datos);
            return $data;
        }
    }

?>