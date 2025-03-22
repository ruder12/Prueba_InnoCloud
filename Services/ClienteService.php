<?php 
class ClienteService extends Controllers{

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

    public function getAllClientes()
    {
        if (!$this->model) {
            die("Error: Modelo no cargado.");
        }

        $arrData = $this->model->all();

        return $arrData;
    }

    public function add(String $name, String $email){ 
        if (!$this->model) {
            die("Error: Modelo no cargado.");
        }

        $insert = $this->model->save($name, $email);
        return $insert;
    }
}