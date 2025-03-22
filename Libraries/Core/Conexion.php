<?php
class Conexion {
    private $conect;

    public function __construct()
	{
		$sqlCon="mysql:host=".DB_HOST.";dbname=".DB_NAME.";".DB_CHARSET;
		try {
			$this->conect = new PDO($sqlCon,DB_USER,DB_PASS);
			$this->conect->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
		} catch (Exception $e) {
			//$this->connect = "Error de Conexion";
            $this->conect = null; // Asegurar que no almacene una cadena incorrecta
            error_log("Error de conexión: " . $e->getMessage()); // Registrar el error
            die("ERROR: No se pudo conectar a la base de datos. ".$e->getMessage()); // Mostrar error controlado
		}
	}

    public function conect(): ?PDO {
        return $this->conect;
    }
}
?>