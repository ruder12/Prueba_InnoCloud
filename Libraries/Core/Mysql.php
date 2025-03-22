<?php 

class Mysql extends Conexion
{
    private $conexion;

    public function __construct()
    {
        try {
            $this->conexion = (new Conexion())->conect();
        } catch (PDOException $e) {
            die("Error de conexión: " . $e->getMessage());
        }
    }

    // Método genérico para ejecutar consultas preparadas
    private function executeQuery(string $query, array $arrValues = [])
    {
        try {
            $stmt = $this->conexion->prepare($query);
            $stmt->execute($arrValues);
            return $stmt;
        } catch (PDOException $e) {
            error_log("Error en consulta: " . $e->getMessage());
            return false;
        }
    }

    // Insertar un registro y devolver el ID generado
    public function insert(string $query, array $arrValues)
    {
        $stmt = $this->executeQuery($query, $arrValues);
        return ($stmt) ? $this->conexion->lastInsertId() : 0;
    }

    // Busca un solo registro
    public function select(string $query, array $arrValues = [])
    {
        $stmt = $this->executeQuery($query, $arrValues);
        return ($stmt) ? $stmt->fetch(PDO::FETCH_ASSOC) : [];
    }

    // Devuelve todos los registros
    public function select_all(string $query, array $arrValues = [])
    {
        $stmt = $this->executeQuery($query, $arrValues);
        return ($stmt) ? $stmt->fetchAll(PDO::FETCH_ASSOC) : [];
    }

    // Actualiza registros
    public function update(string $query, array $arrValues)
    {
        return (bool) $this->executeQuery($query, $arrValues);
    }

    // Eliminar un registro
    public function delete(string $query, array $arrValues = [])
    {
        return (bool) $this->executeQuery($query, $arrValues);
    }
}
?>

