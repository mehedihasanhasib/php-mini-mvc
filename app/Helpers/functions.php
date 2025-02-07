<?php

use App\Core\Auth;
use App\Core\Route;
use App\Core\Session;

function layout(string $layout, array $data = [])
{
    $layout_folder = ".views.layouts.";
    extract($data);
    include BASE_PATH . str_replace(".", DIRECTORY_SEPARATOR, $layout_folder) . $layout . ".php";
}

function component(string $component, array $data = [])
{
    $component_folder = ".views.components.";
    extract($data);
    include BASE_PATH . str_replace(".", DIRECTORY_SEPARATOR, $component_folder) . $component . ".php";
}

function route($name, $params = [])
{
    // global $router;
    // return $router->url($name, $params);

    return Route::url($name, $params);
}

function redirect($url = "/", $status_code = 200)
{
    http_response_code($status_code);
    header("Location: $url");
    exit;
}

function json_response($data, $status_code = 200)
{
    http_response_code($status_code);
    header('Content-Type: application/json');
    $response = $data;
    echo json_encode($response);
    exit;
}

function asset($path)
{
    $baseUrl = ($_SERVER['HTTPS'] ?? 'off') === 'on' ? "https://{$_SERVER['HTTP_HOST']}" : "http://{$_SERVER['HTTP_HOST']}";
    return $baseUrl . '/' . ltrim($path, '/');
    // return $_SERVER['SERVER_NAME'] . '/' . ltrim($path, '/');
}

function auth()
{
    if (\App\Core\Session::get('auth')) {
        return Auth::user();
    } else {
        return false;
    }
}

function public_path($path = "")
{
    // dd(str_replace('\\', "/", $path));
    return BASE_PATH . "/" . str_replace('\\', "/", $path);
}

function isRoute($path)
{
    return parse_url($_SERVER["REQUEST_URI"])["path"] === $path;
}

function sanitize_input($input)
{
    return htmlspecialchars($input);
}

function isActiveRoute($route)
{
    return isRoute($route) ? 'active' : '';
}

function csrf_token()
{
    if (Session::has('csrf_token')) {
        return Session::get('csrf_token');
    }
    
    Session::put('csrf_token', bin2hex(random_bytes(32)));
    return Session::get('csrf_token');
}

function dd($value)
{
    echo '<pre>';
    var_dump($value);
    echo "</pre>";
    http_response_code(500);
    exit;
}
