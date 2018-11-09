<?php
    namespace Projekat\Models;

    use Projekat\Core\Model;

    class KompanijaModel extends Model {

        public function getFileds():array{

            return [

                'kompanija_id'       =>          '',
                'naziv_kompanije'    =>          '',
                'grad'               =>          '',
                'postanski_broj'     =>          '',
                'zemlja'             =>          '',
                'ziro_racun'         =>          '',
                'PIB'                =>          '',
                'kontakt_telefon'    =>          '',
                'logo'               =>          '',
                'kontakt_osoba'      =>          '',
                
            ];
        }

        public function search($keyword){

            $tableName = 'kompanija';
            $sql = "SELECT * FROM " .  $tableName . " WHERE naziv_kompanije LIKE '%$keyword%'";
            $prep = $this->getConnection()->prepare($sql);   
            $res = $prep->execute();
            $items = [];
            if($res){
                $items = $prep->fetchAll(\PDO::FETCH_OBJ);
            }
       
            return $items;
        }

    }