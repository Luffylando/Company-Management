<?php
    namespace Projekat\Core;

    class DbConfiguration {
        private $host;
        private $user;
        private $pass;
        private $name;

        public function __construct($host, $user, $pass, $name){
            $this->host = $host;
            $this->user = $user;
            $this->pass = $pass;
            $this->name = $name;

        }

        public function getSourceString(){
            return "mysql:host={$this->host};dbname={$this->name};charset=utf8";
        }

        public function getUser(){
            return $this->user;
        }

        public function getPass(){
            return $this->pass;
        }
    }