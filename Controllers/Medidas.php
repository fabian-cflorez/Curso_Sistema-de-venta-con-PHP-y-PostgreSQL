<?php
    class Medidas extends Controller
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

        public function index()
        {
            $this->views->getView($this, "index");
        }

        public function listar()
        {
            $data = $this->model->getMedidas();
            for($i=0; $i < count($data);$i++)
            {
                if($data[$i]['estado'] == 1)
                {
                    $data[$i]['estado'] =  '<span class="badge badge-success">Activo</span>';
                    $data[$i]['acciones'] = '<div>
                    <button class="btn btn-primary" type="button" onclick="btnEditarMed('.$data[$i]['id'].');"><i class="fas fa-edit"></i></button>
                    <button class="btn btn-danger" type="button" onclick="btnEliminarMed('.$data[$i]['id'].')"><i class="fas fa-trash-alt"></i></button>
                    </div>';
                }else{
                    $data[$i]['estado'] = '<span class="badge badge-danger">Inactivo</span>';
                    $data[$i]["acciones"] = '<div>
                    <button class="btn btn-success" type="button" onclick="btnReingresarMed('.$data[$i]['id'].')"><i class="fas fa-toggle-on"></i></button>
                    </div>';
                }
            }
            echo json_encode($data, JSON_UNESCAPED_UNICODE);
            die();
        }


        public function registrar()
        {
            //print ("He llegado a registrar controller");
            $id = $_POST['id'];
            $nombre = $_POST['nombre'];
            $nombre_corto = $_POST['nombre_corto'];
            if(empty($nombre) || empty($nombre_corto))
            {
                $msg = "Todos los campos son obligatorios";
            }else{
                if($id == "")
                {
                    $data = $this->model->registrarMedidas($nombre, $nombre_corto);
                    if($data == "Ok")
                    {
                        $msg = "si";
                    }else if($data == "existe")
                    {
                        $msg = "La medida ya existe";
                    }else{
                        $msg = "Error al registrar la medida";
                    }
                }else{
                    $data = $this->model->modificarMedidas($nombre, $nombre_corto, $id);
                    if($data == "modificado")
                    {
                        $msg = "modificado";
                    }else{
                        $msg = "Error al modificar la Medida";
                    }
                }
            }
            //print ("\n"."Medidas ".$msg."\n");
            echo json_encode($msg, JSON_UNESCAPED_UNICODE);
            die();
        }


        public function editar(int $id)
        {
            $data = $this->model->editarMed($id);
            echo json_encode($data, JSON_UNESCAPED_UNICODE);
            die();
        }


        public function eliminar(int $id)
        {
            $data = $this->model->accionMed(0, $id);
            if($data == 1)
            {
                $msg = "ok";
            }else{
                $$msg = "Error al eliminar la medida";
            }
            echo json_encode($msg, JSON_UNESCAPED_UNICODE);
            die();
        }


        public function reingresar(int $id)
        {
            $data = $this->model->accionMed(1, $id);
            if($data == 1)
            {
                $msg = "ok";
            }else{
                $msg = "Error al activar la medida";
            }
            echo json_encode($msg, JSON_UNESCAPED_UNICODE);
            die();
        }
    }
?>