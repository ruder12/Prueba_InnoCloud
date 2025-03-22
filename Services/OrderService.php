<?php 
class OrderService extends Controllers{

    public function __construct()   
    {
        header("Access-Control-Allow-Origin: *"); // Permitir acceso desde cualquier origen
        header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS"); // Métodos permitidos
        header("Access-Control-Allow-Headers: Content-Type, Authorization"); // Cabeceras permitidas

        if ($_SERVER['REQUEST_METHOD'] == "OPTIONS") {
            http_response_code(200);
            exit();
        }
        parent::__construct();
    }

    public function getAllOrders()
    {
        if (!$this->model) {
            die("Error: Modelo no cargado.");
        }

        $arrData = $this->model->all();

        return $arrData;
    }

    public function add(String $cliente,$details){ 
        if (!$this->model) {
            die("Error: Modelo no cargado.");
        }
        $created_at = (new DateTime())->format('Y-m-d H:i:s'); 
        $idOrden = $this->model->save($cliente, $created_at);
        $errores = [];
        if ($idOrden <= 0) {
            $errores[] = "Error al guardar la orden.";
            return $errores;
        }
        
        foreach ($details as $item) {
            $idProducto = isset($item['idproducto']) ? intval($item['idproducto']) : 0;
            $cantidad = isset($item['cantidad']) ? intval($item['cantidad']) : 0;
            $total = isset($item['total']) ? intval($item['total']) : 0;
    
   
            if ($idProducto <= 0 || $cantidad <= 0 || $total <= 0) {
                $errores[] = "Producto o cantidad inválida en el detalle.";
                continue;
            }

            $product = $this->model->getProductById($idProducto);
            if (empty($product)) {
                $errores[] = "No se encontró el producto con ID $idProducto.";
                continue;
            }
   
            if ($product['stock'] < $cantidad) {
                $errores[] = "No hay suficiente stock del producto con ID $idProducto.";
                continue;
            }
            // Actualizar stock del producto
            $this->model->updateStock($idProducto, $product['stock'] - $cantidad);
    
            // Guardar detalle de la orden
            $result = $this->addOrderDetail($idOrden, $idProducto, $cantidad,$total);
            if (!$result) {
                $errores[] = "No se pudo agregar el producto con ID $idProducto.";
            }
        }
    
        return $errores;
    }

    public function addOrderDetail(int $idOrder, int $idProduct,int $quantity,int $total){
        if (!$this->model) {
            die("Error: Modelo no cargado.");
        }
        $insert = $this->model->saveDetail($idOrder, $idProduct,$quantity,$total);
        return $insert;
    }
}