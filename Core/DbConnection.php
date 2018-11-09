<?php
    namespace Projekat\Core;

    use \PDO;

    class DbConnection {

        private $connection;
        private $configuration;

        public function __construct(DbConfiguration $dbConfiguration){
            $this->configuration = $dbConfiguration;
        }

        public function getConnection(){
            if($this->connection === null){
                $this->connection = new PDO($this->configuration->getSourceString(),
                                            $this->configuration->getUser(),
                                            $this->configuration->getPass());
            }
            
            return $this->connection;
        }    
    }