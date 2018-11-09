<?php
    namespace Projekat\Controllers;

    use Projekat\Core\Controller;
    use Projekat\Models\PaketModel;
    use Projekat\Models\KorisnikModel;
    use Projekat\Models\PartnerModel;




    class PaketController extends Controller {

        public function zlatni() {


            $sesija = $this->getSession()->get('korisnik_id');
            $this->set('sesija', $sesija);

            $korisnikModel = new KorisnikModel($this->getDbConnection());
            $korisnik = $korisnikModel->getById($sesija);
            $this->set('korisnik', $korisnik);      
            
            $partnerModel = new PartnerModel($this->getDbConnection());
            $zlatni = $partnerModel->getAllByFieldValue('naziv_paketa', 'zlatni');
            $this->set('zlatni', $zlatni);
           
        }

        public function srebrni(){

            $sesija = $this->getSession()->get('korisnik_id');
            $this->set('sesija', $sesija);
            $korisnikModel = new KorisnikModel($this->getDbConnection());
            $korisnik = $korisnikModel->getById($sesija);
            $this->set('korisnik', $korisnik);     
            
            $partnerModel = new PartnerModel($this->getDbConnection());
            $srebrni = $partnerModel->getAllByFieldValue('naziv_paketa', 'srebrni');
            $this->set('srebrni', $srebrni);
            
        }

        public function bronzani(){

            $sesija = $this->getSession()->get('korisnik_id');
            $this->set('sesija', $sesija);
            $korisnikModel = new KorisnikModel($this->getDbConnection());
            $korisnik = $korisnikModel->getById($sesija);
            $this->set('korisnik', $korisnik);    

            $partnerModel = new PartnerModel($this->getDbConnection());
            $bronzani = $partnerModel->getAllByFieldValue('naziv_paketa', 'bronzani');
            $this->set('bronzani', $bronzani);
            
        }

        public function paketi(){

            $sesija = $this->getSession()->get('korisnik_id');
            $this->set('sesija', $sesija);


            $korisnikModel = new KorisnikModel($this->getDbConnection());
            $korisnik = $korisnikModel->getById($sesija);
            $this->set('korisnik', $korisnik);      

            $paketiModel = new PaketModel($this->getDbConnection());
            $paketi = $paketiModel->getAll();
            $this->set('paketi', $paketi);


        }

        public function getPaket(){
            $sesija = $this->getSession()->get('korisnik_id');
          
            $korisnikModel = new KorisnikModel($this->getDbConnection());
            $korisnik = $korisnikModel->getById($sesija);
            $this->set('korisnik', $korisnik);   

            if($korisnik->role == 'Gost' || $korisnik->role == null){
                $this->redirect(\Configuration::BASE);
            }
        }


        public function getIzmeniPaket(){
            $sesija = $this->getSession()->get('korisnik_id');
            
            $korisnikModel = new KorisnikModel($this->getDbConnection());
            $korisnik = $korisnikModel->getById($sesija);
            $this->set('korisnik', $korisnik);
           
            $id = filter_input(INPUT_POST, 'id', FILTER_SANITIZE_NUMBER_INT);
            $naziv = filter_input(INPUT_POST, 'naziv', FILTER_SANITIZE_STRING);
            $vrsta = filter_input(INPUT_POST, 'vrsta', FILTER_SANITIZE_STRING);
            $vrednost = filter_input(INPUT_POST, 'vrednost', FILTER_SANITIZE_STRING);
            $opis = filter_input(INPUT_POST, 'opis', FILTER_SANITIZE_STRING);

            $this->set('id', $id);
            $this->set('naziv', $naziv);
            $this->set('vrsta', $vrsta);
            $this->set('vrednost', $vrednost);
            $this->set('opis', $opis);

        }

        public function postIzmeniPaket(){

            $id = filter_input(INPUT_POST, 'id', FILTER_SANITIZE_NUMBER_INT);
            $naziv = filter_input(INPUT_POST, 'naziv', FILTER_SANITIZE_STRING);
            $vrsta = filter_input(INPUT_POST, 'vrsta', FILTER_SANITIZE_STRING);
            $vrednost = filter_input(INPUT_POST, 'vrednost', FILTER_SANITIZE_STRING);
            $opis = filter_input(INPUT_POST, 'opis', FILTER_SANITIZE_STRING);

            $paketiModel = new PaketModel($this->getDbConnection());
            $izmeniPaket = $paketiModel->editById($id,[

                'vrsta_paketa'          => $vrsta,
                'naziv_paketa'          => $naziv,
                'vrednost_paketa'       => $vrednost,
                'opis_stavki_paketa'    => $opis
            ]);

            if($izmeniPaket){

                $this->redirect(\Configuration::BASE . 'paketi');
            } else {

                echo "ERROR";
                die();
            }
        }

            public function deletePaket(){
          
                $str = $_GET['URL'];
                $matches = [];
                preg_match('!\d+!', $str, $matches);
                $id = $matches[0];
           

                $paketiModel = new PaketModel($this->getDbConnection());
                $deletePaket = $paketiModel->deleteById($id);

                if($deletePaket){

                    $this->redirect(\Configuration::BASE . 'paketi');
                } 
            }

        
         
        public function postPaket(){

            $vrsta = filter_input(INPUT_POST, 'vrsta', FILTER_SANITIZE_STRING);
            $naziv = filter_input(INPUT_POST, 'naziv', FILTER_SANITIZE_STRING);
            $vrednost = filter_input(INPUT_POST, 'vrednost', FILTER_SANITIZE_NUMBER_INT);
            $trajanje = filter_input(INPUT_POST, 'trajanje', FILTER_SANITIZE_NUMBER_INT);
            $max = filter_input(INPUT_POST, 'max', FILTER_SANITIZE_NUMBER_INT);
            $opis = filter_input(INPUT_POST, 'opis', FILTER_SANITIZE_STRING);

            $paketiModel = new PaketModel($this->getDbConnection());
            $dodajPaket = $paketiModel->add([

                'vrsta_paketa'                  => $vrsta,
                'naziv_paketa'                  => $naziv,
                'vrednost_paketa'               => $vrednost,
                'trajanje_paketa'               => $trajanje,
                'maksimalan_broj_paketa_u_god'  => $max,
                'opis_stavki_paketa'            => $opis,

            ]);

            if($dodajPaket){
            $this->redirect(\Configuration::BASE . 'paketi');
            }
        }
    }