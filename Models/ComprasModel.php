<?php
    //Se crea la clase con el mismo nombre del archivo y se hereda de la clase Query
    class ComprasModel extends Query
    {
        //Se establecen como privadas las variables que vienen desde el modal registrarUsuario
        private $dni, $nombre, $telefono, $direccion, $estado;

        public function __construct()
        {
            parent::__construct();
        }


        public function getProCod(string $cod)
        {
            $sql = "SELECT * FROM productos WHERE codigo = '$cod'";
            $data = $this->select($sql);
            return $data;
        }

        public function getProductos(int $id)
        {
            $sql = "SELECT * FROM productos WHERE id = $id";
            $data = $this->select($sql);
            return $data;
        }

        //funcion en la que se van a almacenar los pedidos temporalmente
        public function registrarDetalle(int $id_producto, int $id_usuario, string $precio, int $cantidad, string $sub_total)
        {
            $this->id_producto = $id_producto;
            $this->id_usuario = $id_usuario;
            $this->precio = $precio;
            $this->cantidad = $cantidad;
            $this->sub_total = $sub_total;
            $sql = "INSERT INTO detalle(id_producto, id_usuario, precio, cantidad, sub_total) VALUES (?,?,?,?,?)";
            $datos = array($this->id_producto, $this->id_usuario, $this->precio, $this->cantidad, $this->sub_total);
            $data = $this->save($sql, $datos);
            if ($data == 1)
            {
                $res = "Ok";
            }else{
                $res = "Error";
            }
            //print $res;exit;
            return $res;
        }


        public function getDetalle(int $id_usuario)
        {
            //$this->id_usuario = $id_usuario;
            //$sql = "SELECT * FROM detalle WHERE id_usuario = $id_usuario";
            
            
            /*
            La segunda sentencia sql incluye el dato del id de la tabla producto y de resto hace lo mismo
            que se explica en la siguiente consulta sql, sin embargo en pruebas logro determinar que sin
            ese id se obtiene la misma respueta, por lo cual en la siguiente lo elimino
             */
            //$sql = "SELECT d.*, p.id AS id_pro, p.descripcion FROM detalle d INNER JOIN productos p ON d.id_producto = p.id WHERE d.id_usuario = $id_usuario";
            

            /*
            Explicacion sentencia de consulta:
            Se selecciona todo de la tabla descripcion (d.*) y la columna descripcion de la tabla productos desde
            detalle con el alias d, combinandola con la tabla productos con el alias p que coincida con el valor
            del id_producto de la tabla detalle y el id de la tabla producto donde el valor de id_usuario de la tabla
            detalle sea igual al valor que se pasó por parametro del id_usuario
            */
            $sql = "SELECT d.*, p.descripcion FROM detalle d INNER JOIN productos p ON d.id_producto = p.id WHERE d.id_usuario = $id_usuario ORDER BY id ASC";
            $data = $this->selectAll($sql);
            return $data;
        }


        public function calcularCompra(int $id_usuario)
        {
            #$sql = "SELECT sub_total, SUM(sub_total) AS Total FROM detalle WHERE id_usuario=$id_usuario";
            $sql = "SELECT id_usuario, SUM(sub_total) AS Total FROM detalle WHERE id_usuario=$id_usuario GROUP BY id_usuario;";
            $data = $this->select($sql);
            return $data;
        }


        public function deleteDetalle(int $id)
        {
            $sql = "DELETE FROM detalle WHERE id=?";
            $datos = array($id);
            $data = $this->save($sql, $datos);
            if ($data == 1)
            {
                $res = 'ok';
            }else{
                $res = 'Error';
            }
            //print $res;exit;
            return $res;
        }


        public function consultarDetalle(int $id_producto, int $id_usuario)
        {
            $sql = "SELECT * FROM detalle WHERE id_producto = $id_producto AND id_usuario = $id_usuario";
            $data = $this->select($sql);
            return $data;
        }

        public function actualizarDetalle(string $precio, string $total_cantidad, string $sub_total, int $id_producto, int $id_usuario)
        {
            $this->id_producto = $id_producto;
            $this->id_usuario = $id_usuario;
            $this->precio = $precio;
            $this->total_cantidad = $total_cantidad;
            $this->sub_total = $sub_total;
            //$this->id = $id;//(id_producto, id_usuario, precio, cantidad, sub_total)
            //$sql = "UPDATE detalle SET precio=?, cantidad=?, sub_total=? WHERE id_producto=? AND id_usuario=?";
            $sql = "UPDATE detalle SET precio=?, cantidad=?, sub_total=? WHERE id_producto=? AND id_usuario=?";
            $datos = array($this->precio, $this->total_cantidad, $this->sub_total, $this->id_producto, $this->id_usuario);
            $data = $this->save($sql, $datos);
            if ($data == 1)
            {
                $res = "modificado";
            }else{
                $res = "Error";
            }
            //print $res;exit;
            return $res;
        }

        public function registrarCompras(string $total)
        {
            $fecha_format = "current_timestamp(0)";
            $sql = "INSERT INTO compras(total, fecha) VALUES(?,$fecha_format)";
            //$fecha_format = "Ymd";
            //$fecha_format = "Ymd(His)";
            //$fecha_format = "current_timestamp(0)";
            //$time = time("His");
            //$time = time();
            //print_r($fecha_format."-/-".$time);
            //print_r($fecha_format);
            //die();
            $datos = array($total);
            //$datos = array($total, date($fecha_format));
            $data = $this->save($sql, $datos);
            if ($data == 1)
            {
                $res = "ok";
            }else{
                $res = "Error";
            }
            //print_r($res);
            //exit;
            return $res;
        }


        public function id_compra()
        {
            $sql = "SELECT MAX(id) as id FROM compras";
            $data = $this->select($sql);
            return $data;
        }


        public function registrarDetalleCompra(int $id_compra, int $cantidad, string $precio, string $sub_total, int $id_producto)
        {
            //$fecha_format = "current_timestamp(0)";
            $sql = "INSERT INTO detalle_compras(id_compra, cantidad, precio, sub_total, id_producto) VALUES(?,?,?,?,?)";
            $datos = array($id_compra, $cantidad, $precio, $sub_total, $id_producto);
            $data = $this->save($sql, $datos);
            if ($data == 1)
            {
                $res = "ok";
            }else{
                $res = "Error";
            }
            //print_r($res);
            //exit;
            return $res;
        }


        public function getempresa()
        {
            $sql = "SELECT * FROM configuracion";
            $data = $this->select($sql);
            return $data;
        }


        public function vaciarDetalle(int $id_usuario)
        {
            $sql = "DELETE FROM detalle WHERE id_usuario = ?";
            $datos = array($id_usuario);
            $data = $this->save($sql, $datos);
            if ($data == 1)
            {
                $res = "ok";
            }else{
                $res = "Error";
            }
            //print_r($res);
            //exit;
            return $res;
        }


        public function getProCompra(int $id_compra)
        {
            $sql = "SELECT c.*, d.*, p.id, p.descripcion FROM compras c INNER JOIN detalle_compras d ON c.id = d.id_compra INNER JOIN productos p ON p.id = d.id_producto WHERE c.id = $id_compra";
            $data = $this->selectAll($sql);
            return $data;
        }

        public function getHistorialCompras()
        {
            $sql = "SELECT * FROM compras";
            $data = $this->selectAll($sql);
            return $data;
        }

        public function actualizarStock(int $id_producto, int $stock)
        {
            $sql = "UPDATE productos SET cantidad=? WHERE id=?";
            $datos = array($stock, $id_producto);
            $data = $this->save($sql, $datos);
            return $data;
        }



    }

    

?>