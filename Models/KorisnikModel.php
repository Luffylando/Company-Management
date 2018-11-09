<?php
    namespace Projekat\Models;

    use Projekat\Core\Model;

    class KorisnikModel extends Model {

        public function getFileds():array{

            return [

                'korisnik_id'       =>          '',
                'korisnicko_ime'    =>          '',
                'lozinka'           =>          '',
                'ime'               =>          '',
                'prezime'           =>          '',
                'datum_rodjenja'    =>          '',
                'mobilni'           =>          '',
                'email'             =>          '',
                'role'             =>          '',
                'prihvacen'             =>          '',

            ];
        }

        public function neprihvaceni(){

            $tableName = 'korisnik';
            $sql = "SELECT * FROM $tableName WHERE `prihvacen` = 0";
            $prep = $this->getConnection()->prepare($sql);
            $res = $prep->execute();
            $items = [];
            if($res){

                $items = $prep->fetchAll(\PDO::FETCH_OBJ);
            }
            return $items;
        }

    }