<?php

// class qui gere les route

class route{

    private $path;
    private $controller;
    private $action;
    private $method = 'home';
    private $param;

    public function __construct($route)
    {
        $this->path = $route->path;
        $this->controller = $route->controller;
        $this->action = $route->action;
        $this->method = $route->method;
        $this->param = $route->param;
    }

    public function getPath(){
        return $this->path;
    }
    public function getController(){
        return $this->controller;
    }
    public function getAction(){
        return $this->action;
    }
    public function getMethod(){
        return $this->method;
    }
    public function getParam(){
        return $this->param;
    }
}