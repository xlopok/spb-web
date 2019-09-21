<?php

use Moguta\Exceptions\DbException;
use Moguta\Exceptions\NotFoundException;

try {
    function myAutoLoader(string $className)
    {
        require_once __DIR__ . '/../src/' . $className . '.php';
    }

    spl_autoload_register('myAutoLoader');
    $route = $_GET['route'] ?? '';
    $routes = require_once __DIR__ . '/../src/routes.php';

    $isRouteFound = false;

    foreach ($routes as $pattern => $controllerAndAction) {
        preg_match($pattern, $route, $matches);
        if (!empty($matches)) {
            $isRouteFound = true;
            break;
        }
    }

    if (!$isRouteFound) {
        throw new \Moguta\Exceptions\NotFoundException();
    }
    $postEmail = $_POST['email']?? 'не пойман или неотправлен post';
//    var_dump($postEmail);
//    var_dump($_POST);
    $controllerName = $controllerAndAction[0];
    $actionName = $controllerAndAction[1];

    $controller = new $controllerName();
    $controller->$actionName($postEmail,...$matches);


} catch (NotFoundException $e) {
    echo 'Страница не найдена' . '<br>' . '<a href="/">На главную</a>';
} catch (DbException $e) {
    echo $e->getMessage();
}