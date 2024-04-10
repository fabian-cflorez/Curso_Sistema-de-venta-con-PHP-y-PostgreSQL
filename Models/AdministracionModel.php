<?php

    class AdministracionModel extends Query
    {
        private $dni, $caja, $telefono, $direccion, $id, $estado;

        public function __construct()
        {
            parent::__construct();
        }


        public function getEmpresa()
        {
            $sql = "SELECT * FROM configuracion";
            $data = $this->select($sql);
            return $data;
        }


        public function modificar(string $nit, string $nombre, string $telefono, string $direccion, string $mensaje, int $id)
        {
                $sql = "UPDATE configuracion SET nit=?, nombre=?, telefono=?, direccion=?, mensaje=? WHERE id=?";
                $datos = array($nit, $nombre, $telefono, $direccion, $mensaje, $id);
                $data = $this->save($sql, $datos);
                if($data == 1)
                {
                    $res = 'ok';
                }else{
                    $res = 'error';
                }   
            return $res;
        }

        


    }
?>