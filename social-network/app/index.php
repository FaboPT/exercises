<?php
use App\Controllers\PostController;
use App\Controllers\UserController;
use App\Controllers\ReplyController;

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: GET,POST,PUT,DELETE,OPTIONS");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Origin,Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With,X-Auth-Token");


$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$uri = explode('/', $uri);


$requestMethod = $_SERVER["REQUEST_METHOD"];

$id = null;
if (isset($uri[2])) {
    $id = (int)$uri[2];
}

switch ($uri[1]) {
    case 'posts':
        $controller = new PostController($requestMethod, $id);
        $controller->switchRequest();code...
        break;
    case 'users':
        $controller = new UserController($requestMethod, $id);
        $controller->switchRequest();
        break;
    case'replies':
        $controller = new ReplyController($requestMethod, $id);
        $controller->switchRequest();
        break;
    default:
        header("HTTP/1.1 404 Not Found");
        exit();
        break;
}


