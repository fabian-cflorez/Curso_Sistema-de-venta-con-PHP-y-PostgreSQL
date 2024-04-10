<?php
    //Se crea la clase con el mismo nombre del archivo y se hereda de la clase Query
    class UsuariosModel extends Query
    {
        //Se establecen como privadas las variables que vienen desde el modal registrarUsuario
        //private $usuario, $nombre, $clave, $caja, $estado;
        private $usuario, $nombre, $clave, $id_caja, $estado;

        public function __construct()
        {
            parent::__construct();
        }


        //Se crea la funcion getUsuario y recibe los parametros de la funcion validar() del archivo usuarios.php
        public function getUsuario(string $usuario, string $clave)
        {
            //Se le asigna un string a la variable sql, ese string es la consulta que va a recibir como parametro
            //la funcion select del archivo Query.php
            //$sql = "SELECT * FROM usuarios";
            $sql = "SELECT * FROM usuarios WHERE usuario = '$usuario' AND clave='$clave'";
            //selectAll devuelve solo un resultado de la consulta
            $data = $this->select($sql);
            return $data;
        }
        //Se crea la funcion gerCajas que sera llamada desde el metodo index del controlador Usuario.php para poder
        //obtener los nombres de las cajas existentes y mostrarlas en el opcion del modal de Nuevo usuario del index
        //No requiere parametros
        public function getCajas()
        {
            //Se le asigna un string a la variable sql, ese string es la consulta que va a recibir como parametro
            //la funcion select del archivo Query.php
            //Se configura la consulta en la tabla cajas en donde el estado sea igual a 1
            $sql = "SELECT * FROM caja WHERE estado = 1";
            //selectAll devuelve solo un resultado de la consulta
            $data = $this->selectAll($sql);
            return $data;
        }


        //El metodo getUsuarios() lo llamaremos desde getUsuarios
        public function getUsuarios()
        {
            //Se le asigna un string a la variable sql, ese string es la consulta que va a recibir como parametro
            //la funcion select del archivo Query.php
            //Se ejecuta la consulta para que los datos puedan ser mostrados en el DataTable de tblUsuarios en funciones.js
            $sql = "SELECT u.*, c.id as id_caja, c.caja FROM usuarios u INNER JOIN caja c ON u.id_caja = c.id;";
            //selectAll devuelve todos los resultados de la consulta
            $data = $this->selectAll($sql);
            return $data;
        }


        //Se crea la funcion registrarUsuarios para que se comunique con la bd e inserte los datos
        //Esta funcion sera llamada desde la funcion registrar de Usuarios.php
        public function registrarUsuario(string $usuario, string $nombre, string $clave, int $id_caja)
        {
            //Igualamos la variable usuario con el parametro $usuario y así con cada variable y parametro
            $this->usuario = $usuario;
            $this->nombre = $nombre;
            $this->clave = $clave;
            $this->id_caja = $id_caja;
            //Se crea la variable existe para crear una consulta a la tabla usuarios
            //para saber si ya existe el usuario que se esta tratando de ingresar
            $verificar = "SELECT * FROM usuarios WHERE usuario='$this->usuario'";
            $existe = $this->select($verificar);
            if(empty($existe))
            {
                //se configura la sentencia inserto into
                $sql = "INSERT INTO usuarios(usuario, nombre, clave, id_caja) VALUES(?,?,?,?)";
                //Se crea un array con los datos
                //tanto sql como array seran enviados como parametros de la funcion save del archivo query
                $datos = array($this->usuario, $this->nombre, $this->clave, $this->id_caja);
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


        public function modificarUsuario(string $usuario, string $nombre, int $id_caja, int $id)
        {
            //Igualamos la variable usuario con el parametro $usuario y así con cada variable y parametro
            $this->usuario = $usuario;
            $this->nombre = $nombre;
            $this->id = $id;
            $this->id_caja = $id_caja;
            $sql = "UPDATE usuarios SET usuario = ?, nombre = ?, id_caja = ? WHERE id = ?";
            $datos = array($this->usuario, $this->nombre, $this->id_caja, $this->id);
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
        public function editarUser($id)
        {
            $sql = "SELECT * FROM usuarios WHERE id = $id";
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


        //Funcion que inactiva o activa a un usuario, recibe como parametro un estado y el id del usuario
        public function accionUser(int $estado, int $id)
        {
            $this->id = $id;
            $this->estado = $estado;
            $sql = "UPDATE usuarios SET estado = ? WHERE id = ?";
            $datos = array($this->estado, $this->id);
            $data = $this->save($sql, $datos);
            return $data;
        }
    }

?>