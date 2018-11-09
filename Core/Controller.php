<?php
    namespace Projekat\Core;

    class Controller {
        private $dbc;
        private $data = [];
        private $session;

        public function __pre(){

        }

        public function __construct(DbConnection &$dbc){
            $this->dbc = $dbc;
        }

        public function getDbConnection(){
            return $this->dbc;
        }

        public function getSession(){
            return $this->session;

        }

        public function setSession(\Projekat\Core\Session\Session &$session){

            $this->session = $session;

        }

        public function set($name, $value){

            $result = false;

            if(preg_match('/^[a-z][a-z0-9]+(?:[A-Z][a-z0-9]+)*$/', $name)){
                $this->data[$name] = $value;
                $result = true;
            }
            return $result;
        }

        public function getData(){
            return $this->data;
        }

        public function redirect($path, $code = 303){

            ob_clean();
            header("Location: " . $path, true, $code);
            exit();

        }
    }