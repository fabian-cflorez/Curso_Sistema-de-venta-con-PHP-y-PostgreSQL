<?php
    //Se crea la clase con el mismo nombre del archivo y se hereda de la clase Query
    class ProductosModel extends Query
    {
        private $Producto, $nombre, $estado, $id, $codigo, $descripcion, $precio_compra,
        $precio_venta, $cantidad, $medida, $categoria, $img;

        public function __construct()
        {
            parent::__construct();
        }


        public function getMedidas()
        {
            $sql = "SELECT * FROM medidas WHERE estado = 1";
            $data = $this->selectAll($sql);
            return $data;
        }

        public function getCategorias()
        {
            $sql = "SELECT * FROM categorias WHERE estado = 1";
            $data = $this->selectAll($sql);
            return $data;
        }


        public function getProductos()
        {
            //$sql = "SELECT u.*, c.id as id_caja, c.caja FROM usuarios u INNER JOIN caja c ON u.id_caja = c.id;";
            //$sql = "SELECT * FROM productos";
            
            //DESCRIPCION DE LA CONSULTA
            /*SELECCIONEME (select) todos los productos (SELECT p.*), traigame el id de la tabla medidas con
            alias id_medida (m.id), traigame el nombre con alias de medida (m.nombre AS medida),
            traigame el id de la tabla categorias con alias id_categ(c.id AS id_categ),
            traigame el nombre de la tabla categoria con alias de categoria
            (c.nombre AS categoria) DESDE (FROM) la tabla productos con alias p (productos p)
            CRUZANDO o ACCEDIENDO a otra tabla medidas con alias m(INNER JOIN medidas m) que coincida con
            el valor del campo id_medida de la tabla productos con el id de la tabla medidas(ON p.id_medida = m.id)
            CRUZANDO O ACCEDIENDO con la tabla categorias con alias c (INNER JOIN categorias c)
            que coinda el valor del campo id_categorias de la tabla productos con el id de la tabla 
            categorias */
            $sql = "SELECT p.*, m.id AS id_medida, m.nombre AS medida, c.id AS id_categ, c.nombre AS categoria FROM productos p INNER JOIN medidas m ON p.id_medida = m.id INNER JOIN categorias c ON p.id_categoria = c.id";
            $data = $this->selectAll($sql);
            //print_r($data);
            return $data;
        }


        public function registrarProducto(string $codigo, string $nombre, string $precio_compra, string $precio_venta, int $cantidad, int $medida, int $categoria, string $img)
        {
            $this->codigo = $codigo;
            $this->nombre = $nombre;
            $this->precio_compra = $precio_compra;
            $this->precio_venta = $precio_venta;
            $this->cantidad = $cantidad;
            $this->id_medida = $medida;
            $this->id_categoria = $categoria;
            //Ahora se comenzara a almacenar en la bd el nombre de las imagenes, por lo tanto
            //en la db no se guardad el archivo sino el nombre.
            //el archivo va guardado en una ruta establecida
            $this->img = $img;
            //print $this->img;
            //exit;
            $verificar = "SELECT * FROM productos WHERE codigo='$this->codigo'";
            $existe = $this->select($verificar);
            if(empty($existe))
            {
                $sql = "INSERT INTO productos(codigo, descripcion, precio_compra, precio_venta, cantidad, id_medida, id_categoria, foto) VALUES(?,?,?,?,?,?,?,?)";
                $datos = array($this->codigo, $this->nombre, $this->precio_compra, $this->precio_venta, $this->cantidad, $this->id_medida, $this->id_categoria, $this->img);
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
            //print_r("\n"."Modelo-> ".$res."\n");
            //exit;
            return $res;
        }



        public function modificarProducto(string $codigo, string $nombre, string $precio_compra, string $precio_venta, int $cantidad, int $medida, int $categoria, string $img, int $id)
        {
            $this->codigo = $codigo;
            $this->nombre = $nombre;
            $this->precio_compra = $precio_compra;
            $this->precio_venta = $precio_venta;
            $this->cantidad = $cantidad;
            $this->medida = $medida;
            $this->categoria = $categoria;
            $this->id = $id;
            $this->img = $img;
            $sql = "UPDATE productos SET codigo=?, descripcion=?, precio_compra=?, precio_venta=?, cantidad=?, id_medida=?, id_categoria=?, foto=? WHERE id = ?";
            $datos = array($this->codigo, $this->nombre, $this->precio_compra, $this->precio_venta, $this->cantidad, $this->medida, $this->categoria, $this->img, $this->id);
            $data = $this->save($sql, $datos);
            if($data == 1)
            {
                $res = "modificado";
            }else{
                $res = "error al modificar";
            }
            //print_r($res);
            //exit;
            return $res;
        }


        public function editarProducto($id)
        {
            $sql = "SELECT * FROM productos WHERE id = $id";
            $data = $this->select($sql);
            return $data;
        }


        public function accionProducto(int $estado, int $id)
        {
            $this->id = $id;
            $this->estado = $estado;
            $sql = "UPDATE productos SET estado = ? WHERE id = ?";
            $datos = array($this->estado, $this->id);
            $data = $this->save($sql, $datos);
            return $data;
        }
    }
?>