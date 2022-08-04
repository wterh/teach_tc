<?php
declare(strict_types=1);

namespace app\core;

/**
 * Class Controller
 * @package app\core
 */
abstract class Controller
{
    public $route;
    public $view;
    public $model;

    /**
     * Controller constructor.
     * @param array $route
     */
    public function __construct(array $route)
    {
        $this->route = $route;
        $this->view = new View($route);
        $this->model = $this->loadModel($route['controller']);
    }

    /**
     * @param $name
     * @return bool
     */
    public function loadModel($name)
    {
        $name = ucfirst($name);
        $path = "app\\models\\{$name}";

        if (class_exists($path)) {
            return new $path();
        }
        return false;
    }
}