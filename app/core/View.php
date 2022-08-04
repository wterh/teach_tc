<?php
declare(strict_types=1);

namespace app\core;

/**
 * Class View
 * @package app\core
 */
class View
{
    public $path;
    public $route;
    public $layout = 'default';

    /**
     * View constructor.
     * @param $route
     */
    public function __construct($route)
    {
        $this->route = $route;
        $this->path = "{$route['controller']}/{$route['action']}";
    }

    /**
     * @param array $vars
     */
    public function render(array $vars = [])
    {
        $path = BASE_DIR . "/app/views/{$this->path}.php";

        if (file_exists($path)) {
            ob_start();
            extract($vars);

            require_once "{$path}";
            $content = ob_get_clean();
            require_once BASE_DIR . "/app/views/layouts/{$this->layout}.php";
        } else {
            echo 'No view: ' . $this->path;
        }
    }

    /**
     * @param $url
     */
    public function redirect($url)
    {
        header("Location: {$url}");
        exit();
    }

    /**
     * @param $status
     * @param $message
     */
    public function message($status, $message)
    {
        exit(json_encode([
            'status' => $status,
            'message' => $message
        ]));
    }

    /**
     * @param $url
     */
    public function location($url)
    {
        exit(json_encode(['url' => $url]));
    }

    /**
     * @param $code
     */
    public static function errorCode($code)
    {
        http_response_code($code);

        $path = BASE_DIR . "/app/views/errors/{$code}.php";

        if (file_exists($path)) {
            require_once "{$path}";
        }

        exit();
    }
}