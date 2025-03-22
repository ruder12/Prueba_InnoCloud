<?php
class Order {
    private $service;

    public function __construct(OrderService $service) {
        $this->service = $service;
    }

    public function getAll() {
        $arrData = $this->service->getAllOrders();

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
        $data = json_decode($json, true);
    
        // Validar que el cliente existe
        if (!isset($data['cliente']) || !isset($data['details']) || !is_array($data['details'])) {
            echo json_encode(["status" => false, "msg" => "Datos faltantes o incorrectos."], JSON_UNESCAPED_UNICODE);
            die();
        }
    
        $intCliente = intval($data['cliente']);
        $errores = [];

        if ($intCliente <= 0) {
            echo json_encode(["status" => false, "msg" => "Cliente inválido."], JSON_UNESCAPED_UNICODE);
            die();
        }
        $errores = $this->service->add($intCliente,$data['details']);
    
        if (empty($errores)) {
            echo json_encode(["status" => true, "msg" => "Orden guardada correctamente."], JSON_UNESCAPED_UNICODE);
        } else {
            echo json_encode(["status" => false, "msg" => "Orden guardada con errores.", "errors" => $errores], JSON_UNESCAPED_UNICODE);
        }
        die();
    }
}
?>