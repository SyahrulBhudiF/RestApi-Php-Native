<?php
require_once __DIR__ . '/../vendor/autoload.php';

use App\Controller\ItemController;


header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
header("Access-Control-Max-Age: 3600");

$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$uri = explode('/', $uri);

// all of our endpoints start with /items
// everything else results in a 404 Not Found
if ($uri[1] !== 'items') {
    header("HTTP/1.1 404 Not Found");
    exit();
}

// the item id is, of course, optional and must be a number:
$itemsId = null;
if (isset($uri[2])) {
    $itemsId = (int)$uri[2];
}


// pass the request method and user ID to the PersonController and process the HTTP request:
$controller = new ItemController($itemsId);
$controller->handleRequest();