<?php

define("DEFAULT_USER_AVATAR", "images/user-avatar/default-avatar.jpg");
define("DEFAULT_EVENT_BANNER", "images/image-placeholder.jpg");
define("DEFAULT_BANNER_UPLOAD_PATH", "uploads/banners/");

require_once BASE_PATH . "/app/Core/Router.php";

require_once BASE_PATH . "/routes/web.php";
require_once BASE_PATH . "/routes/api.php";

$uri = parse_url($_SERVER["REQUEST_URI"])["path"];

$method = $_POST['_method'] ?? $_SERVER["REQUEST_METHOD"];

\App\Core\Route::route($uri, $method);

\App\Core\Session::unflash();
