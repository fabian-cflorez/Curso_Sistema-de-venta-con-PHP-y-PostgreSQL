<?php
    //Se crea la clase con el mismo nombre del archivo y se hereda de Controller
    class Clientes extends Controller
    {
        public function __construct()
        {
            session_start();
            if(empty($_SESSION['activo']))
            {
                header("location:".base_url);
            }
            parent::__construct();
        }


        Public function index()
        {
            //$data['cajas'] = $this->model->getCajas();
            $this->views->getView($this, "index");
        }


        public function listar()
        {
            //Se crea el metodo getClientes(), el cual sera llamado desde UsuariosModel.php
            $data = $this->model->getClientes();
            for ($i=0;$i < count($data);$i++)
            {
                if($data[$i]['estado'] == 1)
                {
                    $data[$i]['estado'] = '<span class="badge badge-success">Activo</span>';
                    $data[$i]["acciones"] = '<div>
                    <button class="btn btn-primary" type="button" onclick="btnEditarCli('.$data[$i]['id'].');"><i class="fas fa-edit"></i></button>
                    <button class="btn btn-danger" type="button" onclick="btnEliminarCli('.$data[$i]['id'].')"><i class="fas fa-trash-alt"></i></button>
                    </div>';
                }else
                {
                    $data[$i]['estado'] = '<span class="badge badge-danger">Inactivo</span>';
                     //En el boton Editar, se configura para que al dar clic en el, ejecute la funcion btnEditarUser
                    //y adicionalmente se esta obteniendo el id para posteriormente enviarlo y que la funcion
                    //btnEditarUser lo reciba como parametro
                    $data[$i]["acciones"] = '<div>
                    <button class="btn btn-success" type="button" onclick="btnReingresarCli('.$data[$i]['id'].')"><i class="fas fa-toggle-on"></i></button>
                    </div>';
                };
            }
            echo json_encode($data, JSON_UNESCAPED_UNICODE);
            die();
        }


        /*
        Este metodo es llamado desde la funcion registrarCli y recibe todos los datos del form.
        Aqui nuevamente se realiza validacion de datos y mediante el id permite determiinar si 
        el usuario o cliente existe o no existe, con base en eso entonces determina si inserta un
        nuevo registro o actualiza uno existente.
        */
        public function registrar()
        {
            //print_r($_POST);
            //Se realizan las validaciones desde el lado backend
            $dni = $_POST['dni'];
            $nombre = $_POST['nombre'];
            $telefono = $_POST['telefono'];
            $direccion = $_POST['direccion'];
            $id = $_POST['id'];
            //El id sera el que vaya a permitir si un cliente se encuentra o no en la db
            //
            if(empty($dni) || empty($nombre) || empty($telefono) || empty($direccion))
            {
                $msg = "Todos los campos son obligatorios";
            }else{
                if($id == "")
                {
                    //Si el id se encuentra vacio, significa que es un usuario nuevo por lo que
                    //manda a ejecutar el metodo registrarCliente
                    $data = $this->model->registrarCliente($dni, $nombre, $telefono, $direccion);
                    if($data == "Ok")
                    {
                        $msg = "si";
                    }else if($data == "existe")
                    {
                        $msg = "El Dni ya existe";
                    }else{
                        $msg = "Error al registrar el cliente";
                    }
                }else{
                    //Por el contrario, si el id posee algun valor significa que ya existe un usuario
                    //por lo cual manda a ejecutar el metodo modificarCliente
                    $data = $this->model->modificarCliente($dni, $nombre, $telefono, $direccion, $id);
                    if($data == "modificado")
                    {
                        $msg = "modificado";
                    }else{
                        $msg = "Error al modificar el cliente";
                    }
                }
            }
            echo json_encode($msg, JSON_UNESCAPED_UNICODE);
            die();
        }


        //Se crea la funcion editar que sera llamada desde funciones.js
        //recibe como parametro un id
        public function editar(int $id)
        {
            //Se llama al metodo editarUser y se le envia un parametro id
            $data = $this->model->editarCli($id);
            //Se recibe la respuesta del metodo y se imprime como arreglo
            //print_r($data);
            echo json_encode($data, JSON_UNESCAPED_UNICODE);
            die();
        }


        public function eliminar(int $id)
        {
            $data = $this->model->accionCli(0, $id);
            //print_r($data);
            if($data == 1)
            {
                $msg = "ok";
            }else{
                $msg = "Error al eliminar el cliente";
            }
            //print_r($msg);
            echo json_encode($msg, JSON_UNESCAPED_UNICODE);
            die();
        }


        public function reingresar(int $id)
        {
            $data = $this->model->accionCli(1, $id);
            //print_r($data);
            if($data == 1)
            {
                $msg = "ok";
            }else{
                $msg = "Error al activar el cliente";
            }
            //print_r($msg);
            echo json_encode($msg, JSON_UNESCAPED_UNICODE);
            die();
        }
    }
?>
