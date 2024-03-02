<?php
namespace App\Core;
class Router
{
    private $get = [];
    private $post = [];

    public static function make()
    {
        $router = new self;
        return $router;
    }

    public function get($uri,$action)
    {
    $this->get[$uri] = $action;
    return $this;
    }

    public function post($uri,$action)
    {
        $this->post[$uri] = $action;
        return $this;
    }
    public function resolve($uri, $method)
    {
        if (array_key_exists($uri, $this->{$method})) {
            $action = $this->{$method}[$uri];
            $controller = new $action[0];
            $method = $action[1];

            $controller->{$method}();
        } else {
            throw new Exception('Page not found');
        }
    }
}