<?php
    namespace Projekat\Models;

    use Projekat\Core\Model;

    class PredavanjaModel extends Model {

        public function getFileds():array{

            return [

                'predavanja_id'       =>          '',
                'naziv_predavanja'    =>          '',
                'naziv_kompanije'     =>          '',
                'datum_predavanja'    =>          '',
                'opis_predavanja'     =>          '',
                'broj_sale'           =>          '',
                'ime'                 =>          '',
                'prezime'             =>          '',
                'biografija'          =>          '',
                'slika'               =>          '',

            ];
        }

        public function predavanjaLimit2(){
            
            $tableName = 'predavanja';
            $sql = "SELECT * FROM $tableName LIMIT 2";
            $prep = $this->getConnection()->prepare($sql);
            $res = $prep->execute();
            $items = [];
            if($res){
                $items = $prep->fetchAll(\PDO::FETCH_OBJ);
            }
            return $items;
        }

        public function dodajPredavanjaAjax(){

            $limit = $_POST['commentsNewCount'];
          
            $tableName = 'predavanja';
            $sql = "SELECT * FROM $tableName LIMIT $limit";
            $prep = $this->getConnection()->prepare($sql);
            $res = $prep->execute();
            $items = [];
            if($res){
              
                $items = $prep->fetchAll(\PDO::FETCH_OBJ);
            }
           

            return $items;
           
        }
    }