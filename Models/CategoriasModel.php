<?php
    //Se crea la clase con el mismo nombre del archivo y se hereda de la clase Query
    class CategoriasModel extends Query
    {
        //Se establecen como privadas las variables que vienen desde el modal registrarUsuario
        private $dni, $nombre, $telefono, $direccion, $estado;

        public function __construct()
        {
            parent::__construct();
        }


        public function getCategorias()
        {
            //Se le asigna un string a la variable sql, ese string es la consulta que va a recibir como parametro
            //la funcion select del archivo Query.php
            //$sql = "SELECT * FROM usuarios";
            $sql = "SELECT * FROM categorias";
            //select devuelve solo un resultado de la consulta
            $data = $this->selectAll($sql);
            return $data;
        }
        

        //Esta funcion sera llamada desde la funcion registrar de Usuarios.php
        public function registrarCategoria(string $nombre)
        {
            $this->nombre = $nombre;
            $verificar = "SELECT * FROM categorias WHERE nombre='$this->nombre'";
            $existe = $this->select($verificar);
            if(empty($existe))
            {
                $sql = "INSERT INTO categorias(nombre) VALUES (?)";
                $datos = array($this->nombre);
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


        public function modificarCategoria(int $id, string $nombre)
        {
            $this->id = $id;
            $this->nombre = $nombre;
            $sql = "UPDATE categorias SET nombre = ? WHERE id = ?";
            $datos = array($this->nombre, $this->id);
            $data = $this->save($sql, $datos);
            if($data == 1)
            {
                $res = "modificado";
            }else{
                $res = "error al modificar la categoria";
            }
            return $res;
        }


        //Funcion que se llama desde Usuarios.php
        public function editarCat($id)
        {
            $sql = "SELECT * FROM categorias WHERE id = $id";
            $data = $this->select($sql);
            return $data;
        }


        //Funcion que inactiva o activa a un dni, recibe como parametro un estado y el id del dni
        public function accionCat(int $estado, int $id)
        {
            $this->id = $id;
            $this->estado = $estado;
            $sql = "UPDATE categorias SET estado = ? WHERE id = ?";
            $datos = array($this->estado, $this->id);
            $data = $this->save($sql, $datos);
            return $data;
        }
    }

?>