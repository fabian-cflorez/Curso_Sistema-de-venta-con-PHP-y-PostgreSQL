<?php
    //Se crea la clase con el mismo nombre del archivo y se hereda de Controller
    class Usuarios extends Controller
    {
        public function __construct ()
        {
            session_start();
            parent::__construct();
        }


        Public function index()
        {
            if(empty($_SESSION['activo']))
            {
                header("location:".base_url);
            }
            $data['cajas'] = $this->model->getCajas();
            //Se obtiene 1 registro de los usuarios y se imprime (A manera de prueba)
            //print_r($this->model->getUsuarios());
            $this->views->getView($this, "index", $data);

        }


        public function listar()
        {
            //Se crea el metodo getUsuarios(), el cual sera llamado desde UsuariosModel.php
            $data = $this->model->getUsuarios();
            for ($i=0;$i < count($data);$i++)
            {
                if($data[$i]['estado'] == 1)
                {
                    $data[$i]['estado'] = '<span class="badge badge-success">Activo</span>';
                    $data[$i]["acciones"] = '<div>
                    <button class="btn btn-primary" type="button" onclick="btnEditarUser('.$data[$i]['id'].');"><i class="fas fa-edit"></i></button>
                    <button class="btn btn-danger" type="button" onclick="btnEliminarUser('.$data[$i]['id'].')"><i class="fas fa-trash-alt"></i></button>
                    </div>';
                }else
                {
                    $data[$i]['estado'] = '<span class="badge badge-danger">Inactivo</span>';
                    //En el boton Editar, se configura para que al dar clic en el, ejecute la funcion btnEditarUser
                    //y adicionalmente se esta obteniendo el id para posteriormente enviarlo y que la funcion
                    //btnEditarUser lo reciba como parametro
                    $data[$i]["acciones"] = '<div>
                    <button class="btn btn-success" type="button" onclick="btnReingresarUser('.$data[$i]['id'].')"><i class="fas fa-toggle-on"></i></button>
                    </div>';
                };
            }
            echo json_encode($data, JSON_UNESCAPED_UNICODE);
            die();
        }


        public function validar()
        {
            if(empty($_POST['usuario']) || empty($_POST['clave']))
            {
                $msg = "Los campos estan vacios";
            }else
            {
                //Se obtiene el usuario digitado en el formulario Login
                $usuario = $_POST['usuario'];
                //Se obtiene el clave digitado en el formulario Login
                $clave = $_POST['clave'];
                $hash = hash("SHA256", $clave);
                //Se hace el envio de los parametros usuario y clave para que los reciba la funcion getUsuarios del
                //archivo UsuariosModel.php
                $data = $this->model->getUsuario($usuario, $hash);
                //Se valida si existe o no el usuario
                if($data)
                {
                    $_SESSION['id_usuario'] = $data['id'];
                    $_SESSION['usuario'] = $data['usuario'];
                    $_SESSION['nombre'] = $data['nombre'];
                    $_SESSION['activo'] = true;
                    $msg = "Ok";
                }else{
                    $msg = "Usuario o contraseña incorrecta";
                }
            }
            echo json_encode($msg, JSON_UNESCAPED_UNICODE);
            //Se imprime lo que esta esta en $data (A manera de prueba)
            //print_r($data);
            //Se imprime lo que esta recibiendo con el metodo POST (A manera de prueba)
            //print_r($_POST);
            //Corta las peticiones
            die();
        }

        /*
        Esta funcion cumple solamente con registrar, pero como se modificara para que pueda modificar o actualizar datos de
        usuarios, entonces sufrira importantes cambios, se dejara de backup.
        public function registrar()
        {
            //print_r($_POST);
            //Se realizan las validaciones desde el lado backend
            $usuario = $_POST['usuario'];
            $nombre = $_POST['nombre'];
            $clave = $_POST['clave'];
            $confirmar = $_POST['confirmar'];
            $caja = $_POST['caja'];
            if(empty($usuario) || empty($nombre) || empty($clave) || empty($caja))
            {
                $msg = "Todos los campos son obligatorios";
            }else if($clave != $confirmar)
            {
                $msg = "Las contraseñas no coinciden";
            }else{
                //En caso de que las validaciones sean correctas, entonces se realiza el llamado de la funcion
                //registrarUsuarios mediante el acceso del modelo y luego la funcion
                $data = $this->model->registrarUsuario($usuario, $nombre, $clave, $caja);
                if($data == "Ok")
                {
                    $msg = "si";
                }else if($data == "existe")
                {
                    $msg = "El usuario ya existe";
                }else{
                    $msg = "Error al registrar el usuario";
                }
            }
            echo json_encode($msg, JSON_UNESCAPED_UNICODE);
            die();
        }
        */


        public function registrar()
        {
            //print_r($_POST);
            //Se realizan las validaciones desde el lado backend
            $usuario = $_POST['usuario'];
            $nombre = $_POST['nombre'];
            $clave = $_POST['clave'];
            $confirmar = $_POST['confirmar'];
            $caja = $_POST['caja'];
            $id = $_POST['id'];
            $hash = hash("SHA256", $clave);
            //Se valida que usuario, nombre y caja no esten vacios, sin embargo tener en cuenta que
            //se esta utilizando la misma funcion de registrar para ingresar usuarios como para modificar
            if(empty($usuario) || empty($nombre) || empty($caja))
            {
                $msg = array('msg' => 'Todos los campos son obligatorios', 'icono' => 'warning');
            }else{
                //Se valida que el input tipo hidden no este vacío, esto debido a que si da clic en el boton modificar
                //traera el id del usuario, por lo cual procedera a ejecutar la funcion modificarUsuario
                //y si no hay un id, significa que es un usuario nuevo, por lo que ejecutara la funcion registrarUsuario
                if($id == "")
                {
                    if($clave != $confirmar)
                    {
                        $msg = array('msg' => 'Las contraseñas no coinciden', 'icono' => 'warning');
                    }else{
                        //En caso de que las validaciones sean correctas, entonces se realiza el llamado de la funcion
                        //registrarUsuarios mediante el acceso del modelo y luego la funcion
                        $data = $this->model->registrarUsuario($usuario, $nombre, $hash, $caja);
                        if($data == "Ok")
                        {
                            $msg = array('msg' => 'Usuario registrado con exito', 'icono' => 'success');
                        }else if($data == "existe")
                        {
                            $msg = array('msg' => 'El usuario ya existe', 'icono' => 'warning');
                        }else{
                            $msg = array('msg' => 'Error al registrar el usuario', 'icono' => 'error');
                        }
                    }
                }else{
                    //Se realiza el llamado de la funcion modificarUsuario enviandole los 4 parametros
                    $data = $this->model->modificarUsuario($usuario, $nombre, $caja, $id);
                    if($data == "modificado")
                    {
                        $msg = array('msg' => 'Usuario modificado con exito', 'icono' => 'success');
                    }else{
                        $msg = array('msg' => 'Error al registrar el usuario', 'icono' => 'error');
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
            $data = $this->model->editarUser($id);
            //Se recibe la respuesta del metodo y se imprime como arreglo
            //print_r($data);
            echo json_encode($data, JSON_UNESCAPED_UNICODE);
            die();
        }


        public function eliminar(int $id)
        {
            $data = $this->model->accionUser(0, $id);
            //print_r($data);
            if($data == 1)
            {
                $msg = array('msg' => 'El usuario ha sido eliminado con exito', 'icono' => 'success');
            }else{
                $msg = array('msg' => 'Error al eliminar el usuario', 'icono' => 'warning');
            }
            //print_r($msg);
            echo json_encode($msg, JSON_UNESCAPED_UNICODE);
            die();
        }


        public function reingresar(int $id)
        {
            $data = $this->model->accionUser(1, $id);
            //print_r($data);
            if($data == 1)
            {
                $msg = array('msg' => 'El usuario ha sido activado con exito', 'icono' => 'success');
            }else{
                $msg = array('msg' => 'Error al activar el usuario', 'icono' => 'warning');
            }
            //print_r($msg);
            echo json_encode($msg, JSON_UNESCAPED_UNICODE);
            die();
        }

        //Funcion para el logout o cierre de sesion del usuario y que retorne a la URL home
        public function salir()
        {
            session_destroy();
            header("location:".base_url);
        }
    }

?>
