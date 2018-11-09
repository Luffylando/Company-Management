<?php
    namespace Projekat\Models;

    use Projekat\Core\Model;

    class UgovoriModel extends Model {

        public function getFileds():array{

            return [

                'ugovori_id'                 =>   '',
                'naziv_kompanije'            =>   '',
                'vrsta_ugovora'              =>   '',
                'naziv_paketa'               =>   '',
                'vrednost_ugovora'           =>   '',
                'email'                      =>   '',
                'datum_sklapanja_ugovora'    =>   '',
                'datum_isticanja_ugovora'    =>   '',
                'status_ugovora'             =>   '',
                'ugovor_sklopio'             =>   '',
            ];
        }

        public function getLast5($fieldName){

            $tableName = 'ugovori';
            $sql = "SELECT * FROM $tableName ORDER BY `$tableName`" . ' . ' . " `$fieldName` DESC LIMIT 10";
            $prep = $this->getConnection()->prepare($sql);
            $res = $prep->execute();
            $items = [];
            if($res){
                $items = $prep->fetchAll(\PDO::FETCH_OBJ);
            }

            return $items;
        }

        public function getExpire5(){          ;

            $sql = "SELECT * FROM `ugovori`
            WHERE datum_isticanja_ugovora <= DATE(NOW() + INTERVAL 60 DAY)
            AND datum_isticanja_ugovora > DATE(NOW()) LIMIT 5";
            $prep = $this->getConnection()->prepare($sql);
            $res = $prep->execute();
            $items = [];
            if($res){
                $items = $prep->fetchAll(\PDO::FETCH_OBJ);
            }

            return $items;
        }

        public function getCompanyById($id){    

            $sql = "SELECT * FROM `ugovori`
            WHERE ugovori_id = ?";
            $prep = $this->getConnection()->prepare($sql);
            $res = $prep->execute([ $id ]);
            $item = null;
            if($res){
                $item = $prep->fetch(\PDO::FETCH_OBJ);
            }

            return $item;
        }

        public function pretragaPartnera($keyword1, $keyword2){

            $tableName = 'ugovori';

             $sql = "SELECT * FROM `$tableName` WHERE `naziv_kompanije` LIKE '%$keyword1%'
             AND `naziv_paketa` LIKE '%$keyword2%' AND `datum_isticanja_ugovora` > DATE(NOW())";
             $prep = $this->getConnection()->prepare($sql);   
             $res = $prep->execute([ $keyword1, $keyword2]);
             $items = [];
             if($res){
                 $items = $prep->fetchAll(\PDO::FETCH_OBJ);
             }
 
             return $items;
        }

        public function pretragaPartnera2($keyword1){

            $tableName = 'ugovori';

             $sql = "SELECT * FROM `$tableName` WHERE `naziv_paketa` LIKE '%$keyword1%'
              AND `datum_isticanja_ugovora` < DATE(NOW())";
             $prep = $this->getConnection()->prepare($sql);
             $res = $prep->execute([ $keyword1]);
             $items = [];
             if($res){
                 $items = $prep->fetchAll(\PDO::FETCH_OBJ);
             }
 
             return $items;
        }

        public function pretragaPartnera3($keyword1){

            $tableName = 'ugovori';

             $sql = "SELECT * FROM `$tableName` WHERE `naziv_kompanije` LIKE '%$keyword1%'
              AND `datum_isticanja_ugovora` < DATE(NOW())";
             $prep = $this->getConnection()->prepare($sql);            
             $res = $prep->execute([ $keyword1]);
             $items = [];
             if($res){
                 $items = $prep->fetchAll(\PDO::FETCH_OBJ);
             }
 
             return $items;
        }

        public function pretragaPartnera4(){

            $tableName = 'ugovori';

             $sql = "SELECT * FROM `$tableName` LIMIT 10";
             $prep = $this->getConnection()->prepare($sql);            
             $res = $prep->execute();
             $items = [];
             if($res){
                 $items = $prep->fetchAll(\PDO::FETCH_OBJ);
             }
 
             return $items;
        }

        public function pretragaPartnera5(){

            $tableName = 'ugovori';

             $sql = "SELECT * FROM `$tableName` WHERE `datum_isticanja_ugovora` < DATE(NOW())";
             $prep = $this->getConnection()->prepare($sql);
             $res = $prep->execute();
             $items = [];
             if($res){
                 $items = $prep->fetchAll(\PDO::FETCH_OBJ);
             }
 
             return $items;
        }

        public function pretragaPartnera6($keyword1, $keyword2){

            $tableName = 'ugovori';

             $sql = "SELECT * FROM `$tableName` WHERE `naziv_kompanije` LIKE '%$keyword1%'
             AND `naziv_paketa` LIKE '%$keyword2%' AND `datum_isticanja_ugovora` < DATE(NOW())";     
             $prep = $this->getConnection()->prepare($sql);   
             $res = $prep->execute([ $keyword1, $keyword2]);
             $items = [];
             if($res){
                 $items = $prep->fetchAll(\PDO::FETCH_OBJ);
             }
 
             return $items;
        }

        public function pretragaPartnera7($keyword1){

            $tableName = 'ugovori';

             $sql = "SELECT * FROM `$tableName` WHERE `naziv_kompanije` LIKE '%$keyword1%'
              AND `datum_isticanja_ugovora` > DATE(NOW())";
             $prep = $this->getConnection()->prepare($sql);            
             $res = $prep->execute([ $keyword1]);
             $items = [];
             if($res){
                 $items = $prep->fetchAll(\PDO::FETCH_OBJ);
             }
 
             return $items;
        }

        public function pretragaPartnera8($keyword1){

            $tableName = 'ugovori';

             $sql = "SELECT * FROM `$tableName` WHERE `naziv_paketa` LIKE '%$keyword1%'
              AND `datum_isticanja_ugovora` > DATE(NOW())";
             $prep = $this->getConnection()->prepare($sql);
             $res = $prep->execute([ $keyword1]);
             $items = [];
             if($res){
                 $items = $prep->fetchAll(\PDO::FETCH_OBJ);
             }
 
             return $items;
        }

        public function pretragaPartnera9($keyword1){

            $tableName = 'ugovori';

             $sql = "SELECT * FROM `$tableName` WHERE `naziv_kompanije` LIKE '%$keyword1%'";
             $prep = $this->getConnection()->prepare($sql);
             $res = $prep->execute([ $keyword1]);
             $items = [];
             if($res){
                 $items = $prep->fetchAll(\PDO::FETCH_OBJ);
             }
 
             return $items;
        }

        public function pretragaPartnera10($keyword1, $keyword2){

            $tableName = 'ugovori';

             $sql = "SELECT * FROM `$tableName` WHERE `naziv_kompanije` LIKE '%$keyword1%'
              AND `naziv_paketa` LIKE '%$keyword2%'";
             $prep = $this->getConnection()->prepare($sql);
             $res = $prep->execute([ $keyword1, $keyword2]);
             $items = [];
             if($res){
                 $items = $prep->fetchAll(\PDO::FETCH_OBJ);
             }
 
             return $items;
        }

        public function pretragaPartnera11($keyword1){

            $tableName = 'ugovori';

             $sql = "SELECT * FROM `$tableName` WHERE `naziv_paketa` LIKE '%$keyword1%'";
             $prep = $this->getConnection()->prepare($sql);
             $res = $prep->execute([ $keyword1]);
             $items = [];
             if($res){
                 $items = $prep->fetchAll(\PDO::FETCH_OBJ);
             }
 
             return $items;
        }

        public function pretragaPartnera12(){

            $tableName = 'ugovori';

             $sql = "SELECT * FROM `$tableName` WHERE `datum_isticanja_ugovora` > DATE(NOW())";
             $prep = $this->getConnection()->prepare($sql);
             $res = $prep->execute();
             $items = [];
             if($res){
                 $items = $prep->fetchAll(\PDO::FETCH_OBJ);
             }
 
             return $items;
        }

        public function sestMeseci(){

            $tableName = 'ugovori';
            $sql = "SELECT * FROM `$tableName` WHERE `datum_isticanja_ugovora` < DATE(NOW() + INTERVAL 6 MONTH)
             AND `datum_isticanja_ugovora` > DATE(NOW())";
            $prep = $this->getConnection()->prepare($sql);
            $res = $prep->execute();
            $items = [];
            if($res){
                $items = $prep->fetchAll(\PDO::FETCH_OBJ);
            }

            return $items;
       }

       public function istekli(){

        $tableName = 'ugovori';
        $sql = "SELECT * FROM `$tableName` WHERE `datum_isticanja_ugovora` < DATE(NOW())
         AND `datum_isticanja_ugovora` > DATE(NOW() - INTERVAL 6 MONTH)";
        $prep = $this->getConnection()->prepare($sql);
        $res = $prep->execute();
        $items = [];
        if($res){
            $items = $prep->fetchAll(\PDO::FETCH_OBJ);
        }

        return $items;
   }

   public function getUgovoriAjax(){

    $limit = $_POST['commentsNewCount'];

    $tableName = 'ugovori';
        $sql = "SELECT * FROM `$tableName` LIMIT $limit";
        $prep = $this->getConnection()->prepare($sql);
        $res = $prep->execute();
        $items = [];
        if($res){
            $items = $prep->fetchAll(\PDO::FETCH_OBJ);
        }

        return $items;
         }

         public function joinTables($id){


            $sql = "SELECT ugovori.ugovori_id, ugovori.naziv_kompanije, `vrsta_ugovora`,
                    `vrednost_ugovora`, `datum_sklapanja_ugovora`,
                    `datum_isticanja_ugovora`, `ugovor_sklopio`, `logo`, `kontakt_telefon`
                    FROM `ugovori`
                    LEFT JOIN `kompanija` ON ugovori.naziv_kompanije = kompanija.naziv_kompanije
                    WHERE ugovori.ugovori_id = ?";

            $prep = $this->getConnection()->prepare($sql);
            $res = $prep->execute([ $id ]);
            $item = null;
            if($res){
              
                $item = $prep->fetch(\PDO::FETCH_OBJ);
            }
           
            return $item;
        }

   }
