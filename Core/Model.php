<?php
    namespace Projekat\Core;

    use \PDO;

    class Model {

        private $dbc;

        public function __construct(DbConnection $dbc){
            $this->dbc = $dbc;

        }

        public function getConnection(){
            return $this->dbc->getConnection();
        }

        public function getFields(): array{
            return [];

        }

        public function getTableName(): string {

            $matches = [];
            preg_match('|^.*\\\((?:[A-Z][a-z]+)+)Model$|', static::class, $matches);
            return substr(strtolower(preg_replace('|[A-Z]|', '_$0', $matches[1] ?? '')), 1);
      
        }

        public function getById($id){

            $tableName = $this->getTableName();
            $sql = 'SELECT * FROM ' . $tableName . ' WHERE ' . $tableName . '_id = ?';
            $prep = $this->dbc->getConnection()->prepare($sql);
            $res = $prep->execute([ $id ]);
            $item = null;
            if($res){
                $item = $prep->fetch(PDO::FETCH_OBJ);
            }

            return $item;

        }

        public function getAll() :array{

            $tableName = $this->getTableName();
            $sql = "SELECT * FROM " . $tableName;
            $prep = $this->dbc->getConnection()->prepare($sql);
            $res = $prep->execute();
            $items = [];
            if($res){
                $items = $prep->fetchAll(PDO::FETCH_OBJ);
            }

            return $items;
            
        }

        public function getByFieldValue($fieldName, $value){

            
            $tableName = $this->getTableName();
            $sql = "SELECT * FROM " . $tableName . " WHERE " . $fieldName ." = ?";
            $prep = $this->dbc->getConnection()->prepare($sql);
            $res = $prep->execute([ $value ]);
            $item = null;
            if($res){
                $item = $prep->fetch(PDO::FETCH_OBJ);
            }

            return $item;

        }

        public function getAllByFieldValue($fieldName, $value){
            $tableName = $this->getTableName();
            $sql = "SELECT * FROM " . $tableName . " WHERE " . $fieldName . " = ?";
            $prep = $this->dbc->getConnection()->prepare($sql);
            $res = $prep->execute([ $value ]);
            $items = [];
            if($res){
                $items = $prep->fetchAll(PDO::FETCH_OBJ);
            }

            return $items;
        }

        final public function add(array $data): bool {

            $tableName = $this->getTableName();
    
            $sqlFieldNames = implode(', ', array_keys($data));
            $questionMarks = str_repeat('?,', count($data));
            $questionMarks = substr($questionMarks, 0, -1);
    
            $sql = "INSERT INTO {$tableName} ({$sqlFieldNames}) VALUES ({$questionMarks})";
    
            $prep = $this->dbc->getConnection()->prepare($sql);
            $res = $prep->execute(array_values($data));
                    
            if(!$res) {
                return false;
            }
    
            return $this->dbc->getConnection()->lastInsertId();
                    
        }

        final public function editById(int $id, array $data){
    
            $tableName = $this->getTableName();
    
            $editList = [];
            $values = [];
    
            foreach($data as $fieldName => $value) {
                $editList[] = "{$fieldName} = ?";
                $values[] = $value;
            }
    
            $editString = implode(', ', $editList);
            $values[] = $id;
    
            $sql = "UPDATE {$tableName} SET {$editString} WHERE {$tableName}_id = ?";
            $prep = $this->dbc->getConnection()->prepare($sql);
            return $prep->execute($values);
    
        }

        public function deleteById(int $id){

            $tableName = $this->getTableName();
            $sql = 'DELETE FROM ' . $tableName . ' WHERE ' . $tableName . '_id = ?';
            $prep = $this->dbc->getConnection()->prepare($sql);
            return $prep->execute([ $id ]);

        }
    
    }