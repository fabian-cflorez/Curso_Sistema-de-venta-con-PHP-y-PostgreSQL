<?php
    //Se crea la clase con el mismo nombre del archivo y se hereda de Controller
    class Productos extends Controller
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
            $data['medidas'] = $this->model->getMedidas();
            $data['categorias'] = $this->model->getCategorias();
            //Se obtiene 1 registro de los Productos y se imprime (A manera de prueba)
            //print_r($this->model->getProductos());
            $this->views->getView($this, "index", $data);

        }


        public function listar()
        {
            //Se crea el metodo getProductos(), el cual sera llamado desde ProductosModel.php
            $data = $this->model->getProductos();
            for ($i=0;$i < count($data);$i++)
            {
                //Se configura para que en el datatable muestre la imagen
                $data[$i]['imagen'] = '<img class="img-thumbnail" src="'.base_url."Assets/img/".$data[$i]['foto'].'" width="100">';
                if($data[$i]['estado'] == 1)
                {
                    $data[$i]['estado'] = '<span class="badge badge-success">Activo</span>';
                    $data[$i]["acciones"] = '<div>
                    <button class="btn btn-primary" type="button" onclick="btnEditarProducto('.$data[$i]['id'].');"><i class="fas fa-edit"></i></button>
                    <button class="btn btn-danger" type="button" onclick="btnEliminarProducto('.$data[$i]['id'].')"><i class="fas fa-trash-alt"></i></button>
                    </div>';
                }else
                {
                    $data[$i]['estado'] = '<span class="badge badge-danger">Inactivo</span>';
                    //En el boton Editar, se configura para que al dar clic en el, ejecute la funcion btnEditarUser
                    //y adicionalmente se esta obteniendo el id para posteriormente enviarlo y que la funcion
                    //btnEditarUser lo reciba como parametro
                    $data[$i]["acciones"] = '<div>
                    <button class="btn btn-success" type="button" onclick="btnReingresarProducto('.$data[$i]['id'].')"><i class="fas fa-toggle-on"></i></button>
                    </div>';
                };
            }
            //print($data);
            //print_r($data);
            echo json_encode($data, JSON_UNESCAPED_UNICODE);
            die();
        }


        public function registrar()
        {
            //print_r($_POST);
            //print_r($_FILES);
            //exit;
            //Se realizan las validaciones desde el lado backend
            $codigo = $_POST['codigo'];
            $nombre = $_POST['nombre'];
            $precio_compra = $_POST['precio_compra'];
            $precio_venta = $_POST['precio_venta'];
            $cantidad = $_POST['cantidad'];
            $medida = $_POST['medida'];
            $categoria = $_POST['categoria'];
            $id = $_POST['id'];
            $img = $_FILES['imagen'];
            $name = $img['name'];
            $tmpname = $img['tmp_name'];
            #$destino = "Assets/img/".$name;
            $foto_actual = $_POST['foto_actual'];
            #$foto_delete = $_POST['foto_delete'];
            $fecha = date("YmdHis");
            if(empty($codigo) || empty($nombre) || empty($precio_compra) || empty($precio_venta) || empty($cantidad))
            {
                $msg = "Todos los campos son obligatorios";
            }else{
                /*Se valida si el nombre de algun archivo esta vacío*/
                if (!empty($name))
                {
                    /*Ahora se crea la variable imgNombre con la intencion de que el nuevo nombre
                    de la imagen contenga la fecha*/
                    $imgNombre = $fecha.".jpg";
                    $destino = "Assets/img/".$imgNombre;
                }else if (!empty($foto_actual) && !empty($name)) {
                    $imgNombre = $foto_actual;
                }else{
                    $imgNombre = "default.png";
                }
                if($id == "")
                {
                    $data = $this->model->registrarProducto($codigo, $nombre, $precio_compra, $precio_venta, $cantidad, $medida, $categoria, $imgNombre);
                    if($data == "Ok")
                    {
                        if (!empty($name)) {
                            move_uploaded_file($tmpname, $destino);
                        }
                        //Al cargar la imagen, en la base de datos se almacena solamente su nombre, por eso se
                        //pasa el parametro name
                        //Sentencia para coger el archivo cargado y pasarlo a una carpeta destino
                        $msg = "si";
                    }else if($data == "existe")
                    {
                        $msg = "El Producto ya existe";
                    }else{
                        $msg = "Error al registrar el Producto";
                    }
                }else{
                    $imgDelete = $this->model->editarProducto($id);
                    //print_r ($imgDelete);
                    //exit;
                    #if ($imgDelete['foto']!='default.png' || $imgDelete['foto']!="")
                    if ($imgDelete['foto']!='default.png')
                    {
                        if (file_exists("Assets/img/".$imgDelete['foto']))
                        {
                            //unlink es una funcion que elimina un fichero o archivo
                            unlink("Assets/img/".$imgDelete['foto']);
                        }
                    }
                    $data = $this->model->modificarProducto($codigo, $nombre, $precio_compra, $precio_venta, $cantidad, $medida, $categoria, $imgNombre, $id);
                    if($data == "modificado")
                    {
                        if (!empty($name)) {
                            move_uploaded_file($tmpname, $destino);
                        }
                        $msg = "modificado";
                    }else{
                        $msg = "Error al modificar el Producto";
                    }
                }
            }
            //print_r("\n"."Controlador-> ".$msg."\n");
            //exit;
            echo json_encode($msg, JSON_UNESCAPED_UNICODE);
            die();
            }
        //}


        public function editar(int $id)
        {
            $data = $this->model->editarProducto($id);
            echo json_encode($data, JSON_UNESCAPED_UNICODE);
            die();
        }


        public function eliminar(int $id)
        {
            $data = $this->model->accionProducto(0, $id);
            //print_r($data);
            if($data == 1)
            {
                $msg = "ok";
            }else{
                $msg = "Error al eliminar el Producto";
            }
            //print_r($msg);
            echo json_encode($msg, JSON_UNESCAPED_UNICODE);
            die();
        }


        public function reingresar(int $id)
        {
            $data = $this->model->accionProducto(1, $id);
            //print_r($data);
            if($data == 1)
            {
                $msg = "ok";
            }else{
                $msg = "Error al activar el Producto";
            }
            //print_r($msg);
            echo json_encode($msg, JSON_UNESCAPED_UNICODE);
            die();
        }

        //Funcion para el logout o cierre de sesion del Producto y que retorne a la URL home
        public function salir()
        {
            session_destroy();
            header("location:".base_url);
        }
    }
?>