<?php
declare(strict_types=1);

require_once 'bootstrap.php';

session_start();

use app\core\Router;

$router = new Router(require BASE_DIR . '/app/config/routes.php');
$router->run();