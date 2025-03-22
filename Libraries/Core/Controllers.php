<?php 
class Controllers
{
    protected $model;

    public function __construct()
    {
        $this->loadModel();
    }

    private function loadModel()
    {
        $model = get_class($this) . "Model";
        $routClass = "Models/" . $model . ".php";

        if (file_exists($routClass)) {
            require_once($routClass);
            if (class_exists($model)) {
                $this->model = new $model();
            } else {
                die("Error: La clase '$model' no existe en '$routClass'.");
            }
        } else {
            die("Error: El archivo del modelo '$routClass' no existe.");
        }
    }
}
?>