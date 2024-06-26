<?php

// class pour gerer les requete http

namespace utils;

class httpRequest
{

    private $url;
    private $method;
    private $param;

    public function __construct()
    {
        $this->url = $_SERVER['REQUEST_URI'];
        $this->method = $_SERVER['REQUEST_METHOD'];
    }

    // getter 
    public function getUrl()
    {
        return $this->url;
    }
    public function getMethod()
    {
        return $this->method;
    }
    public function getParam()
    {
        return $this->param;
    }
}
