<?php
class Producto {
    private $service;

    public function __construct(ProductoService $service) {
        $this->service = $service;
    }

    public function getAll() {
        $arrData = $this->service->getAllProductos();

        echo json_encode($arrData, JSON_UNESCAPED_UNICODE);
        die();
    }

    public function getAllByCliente() {
        if (!isset($_GET['clienteId'])) {
            http_response_code(400);
            echo json_encode(["status" => false, "msg" => "Falta el ID de cliente."], JSON_UNESCAPED_UNICODE);
            die();
        }
        $Id = intval($_GET['clienteId']);
        $arrData = $this->service->getAllProductosByCliente($Id);
        echo json_encode($arrData, JSON_UNESCAPED_UNICODE);
        die(); 
    }
    public function save() {
        // Asegurar que la solicitud sea POST
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            http_response_code(405);
            echo json_encode(["status" => false, "msg" => "Método no permitido."], JSON_UNESCAPED_UNICODE);
            die();
        }
    
        $json = file_get_contents('php://input');
        $data = json_decode($json, true); // Convertir JSON a array asociativo
    
    
        if (!isset($data['txtNombre']) || !isset($data['txtStock']) || !isset($data['txtPrecio'])) {
            echo json_encode(["status" => false, "msg" => "Datos faltantes."], JSON_UNESCAPED_UNICODE);
            die();
        }
    
        $strNombre = strClean($data['txtNombre']);
        $intStock = intval($data['txtStock']);
        $intPrecio = doubleval($data['txtPrecio']);
    
        if (!$strNombre || $intStock === false) {
            echo json_encode(["status" => false, "msg" => "Datos inválidos."], JSON_UNESCAPED_UNICODE);
            die();
        }
    
        $request_producto = $this->service->add($strNombre, $intStock,$intPrecio);
    
        if ($request_producto > 0) {
            echo json_encode(["status" => true, "msg" => "Producto guardado correctamente."], JSON_UNESCAPED_UNICODE);
        } else {
            echo json_encode(["status" => false, "msg" => "Error al guardar el producto."], JSON_UNESCAPED_UNICODE);
        }
        die();
    }
}
?>