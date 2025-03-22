<?php
class Cliente {
    private $service;

    public function __construct(ClienteService $service) {
        $this->service = $service;
    }

    public function getAll() {
        $arrData = $this->service->getAllClientes();

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
    
    
        if (!isset($data['txtNombre']) || !isset($data['txtEmail'])) {
            echo json_encode(["status" => false, "msg" => "Datos faltantes."], JSON_UNESCAPED_UNICODE);
            die();
        }
    
        $strNombre = strClean($data['txtNombre']);
        $strEmail = strClean($data['txtEmail']);
    
        if (!$strNombre || $strEmail === false) {
            echo json_encode(["status" => false, "msg" => "Datos inválidos."], JSON_UNESCAPED_UNICODE);
            die();
        }
    
        $request_producto = $this->service->add($strNombre, $strEmail);
    
        if ($request_producto > 0) {
            echo json_encode(["status" => true, "msg" => "Cliente guardado correctamente."], JSON_UNESCAPED_UNICODE);
        } else {
            echo json_encode(["status" => false, "msg" => "Error al guardar el cliente."], JSON_UNESCAPED_UNICODE);
        }
        die();
    }
}
?>