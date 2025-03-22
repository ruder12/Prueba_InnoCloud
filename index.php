<?php
require_once("Config/Config.php");
require_once("Helpers/Helpers.php");

// Obtener la URL y limpiar los datos
$url = isset($_GET['url']) ? filter_var($_GET['url'], FILTER_SANITIZE_URL) : 'home/home';
$arrUrl = explode("/", trim($url, "/"));

// Definir controlador y método
$controller = !empty($arrUrl[0]) ? ucwords($arrUrl[0]) : 'Home';
$method = !empty($arrUrl[1]) ? $arrUrl[1] : 'index';
$params = array_slice($arrUrl, 2); // Capturar todos los parámetros a partir del índice 2

// Cargar Autoload y Load para manejar dependencias y controladores
require_once("Libraries/Core/Autoload.php");
require_once("Libraries/Core/Load.php");
?>
