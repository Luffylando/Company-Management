<?php
    namespace Projekat\Models;

    use Projekat\Core\Model;

    class PosloviModel extends Model {

        public function getFileds():array{

            return [

                'poslovi_id'             =>          '',
                'naziv_posla'            =>          '',
                'naziv_kompanije'        =>          '',
                'opis_posla'             =>          '',

            ];
        }

        public function dodajPosloveAjax(){

            $limit = $_POST['commentsNewCount'];
          
            $tableName = 'poslovi';
            $sql = "SELECT * FROM $tableName LIMIT $limit";
            $prep = $this->getConnection()->prepare($sql);
            $res = $prep->execute();
            $items = [];
            if($res){
              
                $items = $prep->fetchAll(\PDO::FETCH_OBJ);
            }
           

            return $items;
           
        }

        public function posloviLimit2(){

            $tableName = 'poslovi';
            $sql = "SELECT * FROM $tableName LIMIT 2";
            $prep = $this->getConnection()->prepare($sql);
            $res = $prep->execute();
            $items = [];
            if($res){
              
                $items = $prep->fetchAll(\PDO::FETCH_OBJ);
            }
           

            return $items;

        }

        public function getLast5($fieldName){

            $tableName = 'ugovori';
            $sql = "SELECT * FROM $tableName ORDER BY `$tableName`" . ' . ' . " `$fieldName` DESC LIMIT 5";
            $prep = $this->getConnection()->prepare($sql);
            $res = $prep->execute();
            $items = [];
            if($res){
                $items = $prep->fetchAll(\PDO::FETCH_OBJ);
            }

            return $items;
        }
    }