<?php
    namespace Projekat\Core;

    class Route {

        private $requestMethod;
        private $pattern;
        private $controller;
        private $method;


        public function __construct($requestMethod, $pattern, $controller, $method){

            $this->requestMethod    = $requestMethod;
            $this->pattern          = $pattern;
            $this->controller       = $controller;
            $this->method           = $method;

        }

        public static function get($pattern, $controller, $method): Route{
            return new Route('GET', $pattern, $controller, $method);
        }

        public static function post($pattern, $controller, $method): Route{
            return new Route('POST', $pattern, $controller, $method);
        }

        public static function any($pattern, $controller, $method): Route{
            return new Route('GET|POST', $pattern, $controller, $method);
        }

        public function getControllerName(){
            return $this->controller;
        }

        public function getMethodName(){
            return $this->method;
        }

        public function matches($method, $url): bool{

            if(!preg_match('/^' . $this->requestMethod . '$/', $method)){

                return false;
            }
                return boolval(preg_match($this->pattern, $url));
        }

        public function extractArguments($url): array {
            $matches = [];
            $arguments = [];

            preg_match_all($this->pattern, $url, $matches);
            if(isset($matches[1])){
                $arguments = $matches[1];
            }

            return $arguments;
        }

    }