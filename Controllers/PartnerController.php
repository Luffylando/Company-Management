<?php
    namespace Projekat\Controllers;

    
    use Projekat\Core\Controller;
    use Projekat\Models\KorisnikModel;
    use Projekat\Models\PartnerModel;
    use Projekat\Models\PaketModel;
    use Projekat\Models\UgovoriModel;




    class PartnerController extends Controller {

        public function index() {

            $sesija = $this->getSession()->get('korisnik_id');
            $this->set('sesija', $sesija);

            $korisnikModel = new KorisnikModel($this->getDbConnection());
            $korisnik = $korisnikModel->getById($sesija);
            $this->set('korisnik', $korisnik);      

            $paketiModel = new PaketModel($this->getDbConnection());
            $paketi = $paketiModel->getAll();
            $this->set('paketi', $paketi);

        }

        public function getPretragaPartnera() {

            $sesija = $this->getSession()->get('korisnik_id');
            $this->set('sesija', $sesija);

            $korisnikModel = new KorisnikModel($this->getDbConnection());
            $korisnik = $korisnikModel->getById($sesija);
            $this->set('korisnik', $korisnik);      

            
        }

        public function postPretragaPartnera(){

            $sesija = $this->getSession()->get('korisnik_id');
            $this->set('sesija', $sesija);

            $korisnikModel = new KorisnikModel($this->getDbConnection());
            $korisnik = $korisnikModel->getById($sesija);
            $this->set('korisnik', $korisnik);   

            $naziv = filter_input(INPUT_POST, 'naziv_kompanije', FILTER_SANITIZE_STRING);
            $vrsta = filter_input(INPUT_POST, 'vrsta', FILTER_SANITIZE_STRING);
            $activity = filter_input(INPUT_POST, 'activity', FILTER_SANITIZE_STRING);
          
            $partnerModel = new UgovoriModel($this->getDbConnection());



            if($naziv != '' && $vrsta != '' && $activity == '1'){

                $partneri = $partnerModel->pretragaPartnera($naziv, $vrsta);
                $this->set('partneri', $partneri);

            } elseif($naziv != '' && $vrsta != '' && $activity == '0'){

                $partneri = $partnerModel->pretragaPartnera6($naziv, $vrsta);
                $this->set('partneri', $partneri);

            } elseif($naziv == '' && $vrsta == '' && $activity == '0') {
                $partneri = $partnerModel->pretragaPartnera5();
                $this->set('partneri', $partneri);

            } elseif($naziv == '' && $vrsta != '' && $activity == '0'){

                $partneri = $partnerModel->pretragaPartnera2($vrsta);
                $this->set('partneri', $partneri);

            } elseif($vrsta == '' && $activity == '0'){

                $partneri = $partnerModel->pretragaPartnera3($naziv);
                $this->set('partneri', $partneri);

            } elseif($vrsta == '' && $activity == '1'){

                $partneri = $partnerModel->pretragaPartnera7($naziv);
                $this->set('partneri', $partneri);

            } elseif($naziv == '' && $vrsta != '' && $activity == '1'){

                $partneri = $partnerModel->pretragaPartnera8($vrsta);
                $this->set('partneri', $partneri);

            } elseif($naziv != ''  && $vrsta == '' && $activity == null){

                $partneri = $partnerModel->pretragaPartnera9($naziv);
                $this->set('partneri', $partneri);
                
            } elseif($naziv != ''  && $vrsta != '' && $activity == null){

                $partneri = $partnerModel->pretragaPartnera10($naziv, $vrsta);
                $this->set('partneri', $partneri);
                
            } elseif($naziv == ''  && $vrsta != '' && $activity == null){


                $partneri = $partnerModel->pretragaPartnera11($vrsta);
                $this->set('partneri', $partneri);
                
            } else {

                $partneri = $partnerModel->pretragaPartnera4($naziv);
                $this->set('partneri', $partneri);

            }
        }

        public function getPartner() {

            $sesija = $this->getSession()->get('korisnik_id');
            $this->set('sesija', $sesija);

            $korisnikModel = new KorisnikModel($this->getDbConnection());
            $korisnik = $korisnikModel->getById($sesija);
            $this->set('korisnik', $korisnik);   

            $id = $_POST['id'];
            
            $partnerModel = new UgovoriModel($this->getDbConnection());
            $partner = $partnerModel->getCompanyById($id);
            $this->set('partner', $partner);

            $joinTables = new UgovoriModel($this->getDbConnection());
            $tables = $joinTables->joinTables($id);
            $this->set('tables', $tables);
         

        }

        public function izmeniPartnera(){

            $sesija = $this->getSession()->get('korisnik_id');
            $this->set('sesija', $sesija);

            $korisnikModel = new KorisnikModel($this->getDbConnection());
            $korisnik = $korisnikModel->getById($sesija);
            $this->set('korisnik', $korisnik);   
          
  
            $id = $_POST['id'];

            $partnerModel = new UgovoriModel($this->getDbConnection());
            $partner = $partnerModel->getCompanyById($id);
            $this->set('partner', $partner);

            $joinTables = new UgovoriModel($this->getDbConnection());
            $tables = $joinTables->joinTables($id);
            $this->set('tables', $tables);

            
        }

        public function postIzmeniPartnera(){


           $id = filter_input(INPUT_POST, 'id', FILTER_SANITIZE_NUMBER_INT); 
           $naziv = filter_input(INPUT_POST, 'naziv', FILTER_SANITIZE_STRING);
           $paket = filter_input(INPUT_POST, 'paket', FILTER_SANITIZE_STRING);
           $cena = filter_input(INPUT_POST, 'cena', FILTER_SANITIZE_STRING);
           $datum_sklapanja = filter_input(INPUT_POST, 'datum_sklapanja', FILTER_SANITIZE_STRING);
           $datum_isticanja = filter_input(INPUT_POST, 'datum_isticanja', FILTER_SANITIZE_STRING);
           $ugovor_sklopio = filter_input(INPUT_POST, 'ugovor_sklopio', FILTER_SANITIZE_STRING);
           $ugovor_sklopio = filter_input(INPUT_POST, 'ugovor_sklopio', FILTER_SANITIZE_STRING);
     
       

           $partnerModel = new UgovoriModel($this->getDbConnection());
           $partner = $partnerModel->editById($id, [


            
            'naziv_kompanije'            =>   $naziv,
            'naziv_paketa'               =>   $paket,
            'vrednost_paketa'            =>   $cena,
            'datum_sklapanja_ugovora'    =>   $datum_sklapanja,
            'datum_isticanja_ugovora'    =>   $datum_isticanja,
            'ugovor_sklopio'             =>   $ugovor_sklopio,
            

           ]);

           if($partner){

            $this->redirect(\Configuration::BASE . 'pretraga-partnera/');
           }
        }

    }