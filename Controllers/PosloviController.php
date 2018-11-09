<?php
    namespace Projekat\Controllers;

    use Projekat\Core\Controller;
    use Projekat\Models\KorisnikModel;
    use Projekat\Models\PosloviModel;
    use Projekat\Models\PredavanjaModel;
    use Projekat\Models\UgovoriModel;
    use Projekat\Models\KompanijaModel;


    class PosloviController extends Controller {


        public function sviPoslovi() {

            $sesija = $this->getSession()->get('korisnik_id');
            $this->set('sesija', $sesija);

            $korisnikModel = new KorisnikModel($this->getDbConnection());
            $korisnik = $korisnikModel->getById($sesija);
            $this->set('korisnik', $korisnik);      
            
            $posloviModel = new PosloviModel($this->getDbConnection());
            $poslovi = $posloviModel->posloviLimit2();
            $this->set('poslovi', $poslovi); 

                
        }

        public function testAjax(){

            $posloviModel = new PosloviModel($this->getDbConnection());
            $poslovi = $posloviModel->dodajPosloveAjax();
            $this->set('poslovi', $poslovi);


        }
    

        public function predavanja(){

            $sesija = $this->getSession()->get('korisnik_id');
            $this->set('sesija', $sesija);

            $korisnikModel = new KorisnikModel($this->getDbConnection());
            $korisnik = $korisnikModel->getById($sesija);
            $this->set('korisnik', $korisnik);      

            $predavanjaModel = new PredavanjaModel($this->getDbConnection());
            $predavanja = $predavanjaModel->getAll();
            $this->set('predavanja', $predavanja);  

            $predavanjaModel = new PredavanjaModel($this->getDbConnection());
            $predavanja2 = $predavanjaModel->predavanjaLimit2();
            $this->set('predavanja2', $predavanja2);


        }

        public function predavanjaAjax(){

            $predavanjaModel = new PredavanjaModel($this->getDbConnection());
            $predavanja = $predavanjaModel->dodajPredavanjaAjax();
            $this->set('predavanja', $predavanja);


        }

        public function dodajPredavanje(){

            $sesija = $this->getSession()->get('korisnik_id');
            $this->set('sesija', $sesija);

            $korisnikModel = new KorisnikModel($this->getDbConnection());
            $korisnik = $korisnikModel->getById($sesija);
            $this->set('korisnik', $korisnik); 

            $kompanijaModel = new KompanijaModel($this->getDbConnection());
            $kompanije = $kompanijaModel->getAll();
            $this->set('kompanije', $kompanije);  

            if($korisnik->role == null || $korisnik->role == 'Gost'){
                $this->redirect(\Configuration::BASE);
            }



        }

        public function postDodajPredavanje(){

          $naziv = filter_input(INPUT_POST, 'naziv', FILTER_SANITIZE_STRING);
          $predavanje = filter_input(INPUT_POST, 'predavanje', FILTER_SANITIZE_STRING);
          $opis = filter_input(INPUT_POST, 'opis', FILTER_SANITIZE_STRING);
          $datum = filter_input(INPUT_POST, 'datum', FILTER_SANITIZE_STRING);
          $sala = filter_input(INPUT_POST, 'sala', FILTER_SANITIZE_NUMBER_INT);
          $ime = filter_input(INPUT_POST, 'imee', FILTER_SANITIZE_STRING);
          $prezime = filter_input(INPUT_POST, 'prezime', FILTER_SANITIZE_STRING);
          $biografija = filter_input(INPUT_POST, 'biografija', FILTER_SANITIZE_STRING);
          $slika = '...';

      

          $predavanjaModel = new PredavanjaModel($this->getDbConnection());         
          $predavanja = $predavanjaModel->add([

            'naziv_predavanja'    => $predavanje,
            'naziv_kompanije'     => $naziv,
            'datum_predavanja'    => $datum,
            'opis_predavanja'     => $opis,
            'broj_sale'           => $sala,
            'ime'                 => $ime,
            'prezime'             => $prezime,
            'biografija'          => $biografija,
            'slika'               => $slika,


          ]);

          if($predavanja){

            $this->redirect(\Configuration::BASE . 'predavanja');
          } else {

            ob_start();
            echo "ERROR";
          }
          
        }

        public function pojedinacnoPredavanje(){

            $sesija = $this->getSession()->get('korisnik_id');

            $korisnikModel = new KorisnikModel($this->getDbConnection());
            $korisnik = $korisnikModel->getById($sesija);
            $this->set('korisnik', $korisnik); 

            $id = filter_input(INPUT_POST,'id', FILTER_SANITIZE_NUMBER_INT);

            $predavanjaModel = new PredavanjaModel($this->getDbConnection());
            $predavanje = $predavanjaModel->getById($id);
            $this->set('predavanje', $predavanje);

        }

        public function getDodajOglas(){

            $sesija = $this->getSession()->get('korisnik_id');
            $this->set('sesija', $sesija);

            $korisnikModel = new KorisnikModel($this->getDbConnection());
            $korisnik = $korisnikModel->getById($sesija);
            $this->set('korisnik', $korisnik); 

            $kompanijaModel = new KompanijaModel($this->getDbConnection());
            $kompanije = $kompanijaModel->getAll();
            $this->set('kompanije', $kompanije);  

            if($korisnik->role == null || $korisnik->role == 'Gost'){
                $this->redirect(\Configuration::BASE);
            }


        }

        public function postDodajOglas(){

          $naziv_posla = filter_input(INPUT_POST, 'naziv', FILTER_SANITIZE_STRING);
          $naziv_kompanije = filter_input(INPUT_POST, 'kompanija', FILTER_SANITIZE_STRING);
          $opis = filter_input(INPUT_POST, 'opis', FILTER_SANITIZE_STRING);

          $posloviModel = new PosloviModel($this->getDbConnection());
          $poslovi = $posloviModel->add([

             
                'naziv_posla'            => $naziv_posla,
                'naziv_kompanije'        => $naziv_kompanije,
                'opis_posla'             => $opis,
                
          ]);

          if($poslovi){

            $this->redirect(\Configuration::BASE . 'oglasi');
            } else {

                var_dump('ERROR');
                die();
            }
        }
    }