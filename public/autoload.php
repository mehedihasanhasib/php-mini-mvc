<?php
spl_autoload_register(function ($class) {
    $class = str_starts_with($class, "App") ? preg_replace("/App/", "app", $class) : $class;
    $class  = str_replace("\\", DIRECTORY_SEPARATOR, $class) . '.php';
    require BASE_PATH . DIRECTORY_SEPARATOR . "$class";
});
