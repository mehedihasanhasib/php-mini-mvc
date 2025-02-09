<?php
require_once BASE_PATH . "/app/Core/Router.php";
require_once BASE_PATH . "/routes/web.php";
require_once BASE_PATH . "/routes/api.php";

$uri = parse_url($_SERVER["REQUEST_URI"])["path"];

$method = $_POST['_method'] ?? $_SERVER["REQUEST_METHOD"];

\App\Core\Route::route($uri, $method);

\App\Core\Session::unflash();
