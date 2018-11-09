<?php
    namespace Projekat\Core;

    class Router {
        private $routes = [];

        public function __construct(){


        }

        public function add(Route $route){

            $this->routes[] = $route;


        }

        public function find($method, $url){

            foreach($this->routes as $route){
                if($route->matches($method, $url)){
                    return $route;
                }
            }

            return null;

        }
    }