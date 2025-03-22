<?php
spl_autoload_register(function ($class) {
    $paths = ["Libraries/Core/", "Controllers/", "Services/"];
    foreach ($paths as $path) {
        $file = $path . $class . ".php";
        if (file_exists($file)) {
            require_once $file;
        }
    }
});
?>