<?php
    namespace Projekat\Controllers;

    use Projekat\Core\Controller;
    use Projekat\Models\KorisnikModel;
    use Projekat\Models\UgovoriModel;



    class PocetnaController extends Controller {

        public function index() {


            $sesija = $this->getSession()->get('korisnik_id');
            $this->set('sesija', $sesija);

            $korisnikModel = new KorisnikModel($this->getDbConnection());
            $korisnik = $korisnikModel->getById($sesija);
            $this->set('korisnik', $korisnik);          


        // ovo je za vremenski dijagram

        $currentDate = date('Y-m-d H:i:s');
        $sixMounts = date(strtotime($currentDate . '+6 months'));
        $nedelje = intval(6 * 30 / 7);
        $this->set('nedelje', $nedelje);

        $ugovoriModel = new UgovoriModel($this->getDbConnection());
        $ugovori = $ugovoriModel->sestMeseci();
        $this->set('ugovori', $ugovori);

        $ugovoriModel = new UgovoriModel($this->getDbConnection());
        $istekli = $ugovoriModel->istekli();
        $this->set('istekli', $istekli);

        //Za prihvatanje zahteva za uclanjenje;


        $korisnikModel = new KorisnikModel($this->getDbConnection());
        $neprihvaceni = $korisnikModel->neprihvaceni();
        $this->set('neprihvaceni', $neprihvaceni);          



        }

        public function postZahtevi(){

            $id = filter_input(INPUT_POST, 'id', FILTER_SANITIZE_NUMBER_INT);
            $prihvati = filter_input(INPUT_POST, 'prihvati', FILTER_SANITIZE_NUMBER_INT);
            
            if($prihvati == '1'){

                $korisnikModel = new KorisnikModel($this->getDbConnection());
                $dodaj = $korisnikModel->editById($id, [

                    'prihvacen' => 1,
                    'role'      => 'Clan tima',

                ]);

                $this->redirect(\Configuration::BASE);
               
                
            } else {

                $korisnikModel = new KorisnikModel($this->getDbConnection());
                $dodaj = $korisnikModel->deleteById($id);
                $this->redirect(\Configuration::BASE);

        }
    }

        public function error_page(){


            $sesija = $this->getSession()->get('korisnik_id');
            $this->set('sesija', $sesija);
            $korisnikModel = new KorisnikModel($this->getDbConnection());
            $korisnik = $korisnikModel->getById($sesija);
            $this->set('korisnik', $korisnik);          

            
        }

    }