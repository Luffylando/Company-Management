<?php
    namespace Projekat\Controllers;

    use Projekat\Core\Controller;
    use Projekat\Models\KorisnikModel;
    use Projekat\Models\KompanijaModel;



    class KompanijaController extends Controller {

        public function getKompanija() {

            
            $sesija = $this->getSession()->get('korisnik_id');
            $this->set('sesija', $sesija);

            $korisnikModel = new KorisnikModel($this->getDbConnection());
            $korisnik = $korisnikModel->getById($sesija);
            $this->set('korisnik', $korisnik);     
            
            
            if($korisnik->role == 'Gost' || $korisnik->role == null){
                $this->redirect(\Configuration::BASE);
            }
            $kompanijaModel = new KompanijaModel($this->getDbConnection());
            $kompanije = $kompanijaModel->getAll();
            $this->set('kompanije', $kompanije);   
           

        }

        public function postKompanija(){

         
          
            $uploadPath = '/Projekat/Assets/img/companyLogos/';
            $fileName = rand(1, 350000) . $_FILES['logo']['name'];

            $filePath = $uploadPath . $fileName;

            
          
            $naziv_kompanije = filter_input(INPUT_POST, 'naziv_kompanije', FILTER_SANITIZE_STRING);
            $grad = filter_input(INPUT_POST, 'grad', FILTER_SANITIZE_STRING);
            $zip = filter_input(INPUT_POST, 'zip', FILTER_SANITIZE_STRING);
            $zemlja = filter_input(INPUT_POST, 'zemlja', FILTER_SANITIZE_STRING);
            $ziro = filter_input(INPUT_POST, 'ziro', FILTER_SANITIZE_STRING);
            $pib = filter_input(INPUT_POST, 'pib', FILTER_SANITIZE_STRING);
            $telefon = filter_input(INPUT_POST, 'telefon', FILTER_SANITIZE_STRING);
            $logo = filter_input(INPUT_POST, 'logo', FILTER_SANITIZE_STRING);
            $kontakt = filter_input(INPUT_POST, 'kontakt', FILTER_SANITIZE_STRING);
            $link = filter_input(INPUT_POST, 'link', FILTER_SANITIZE_STRING);
            $tmpName = $_FILES['logo']['tmp_name'];


            
            // Check file size
            if ($_FILES["logo"]["size"] > 500000) {
                echo "Sorry, your file is too large.";
            }


            $kompanijaModel = new KompanijaModel($this->getDbConnection());
            $dodajKompaniju = $kompanijaModel->add([


                'naziv_kompanije'           => $naziv_kompanije,
                'grad'                      => $grad,
                'postanski_broj'            => $zip,
                'zemlja'                    => $zemlja,
                'ziro_racun'                => $ziro,
                'pib'                       => $pib,
                'kontakt_telefon'           => $telefon,
                'logo'                      => $filePath,
                'kontakt_osoba'             => $kontakt,
                'link_kompanije'            => $link,



            ]);
 
                if($dodajKompaniju){
                    if($_FILES['logo']['name'] != ''){
                    
                        move_uploaded_file($tmpName, '/var/www/html/Projekat/Assets/img/companyLogos/' . $fileName);
                    }
                    ob_start();
                    $this->redirect(\Configuration::BASE . 'pretraga-kompanija/');

                } else {
                    $this->redirect(\Configuration::BASE . 'error_page');
            }
        }

        public function pretragaKompanija(){
            $sesija = $this->getSession()->get('korisnik_id');
            $this->set('sesija', $sesija);

            $korisnikModel = new KorisnikModel($this->getDbConnection());
            $korisnik = $korisnikModel->getById($sesija);
            $this->set('korisnik', $korisnik);     
            
            $keyword = filter_input(INPUT_POST, 'search', FILTER_SANITIZE_STRING);

            $kompanijaModel = new KompanijaModel($this->getDbConnection());
            $search = $kompanijaModel->search($keyword);
            $this->set('search', $search);
        }

        public function pogledajKompaniju(){

             
            $sesija = $this->getSession()->get('korisnik_id');
            $this->set('sesija', $sesija);

            $korisnikModel = new KorisnikModel($this->getDbConnection());
            $korisnik = $korisnikModel->getById($sesija);
            $this->set('korisnik', $korisnik);

            $str = $_GET["URL"];
            $matches = [];
            preg_match('!\d+!', $str, $matches);
            
            $id = $matches[0];

            $kompanijaModel = new KompanijaModel($this->getDbConnection());
            $kompanija = $kompanijaModel->getById($id);
            $this->set('kompanija', $kompanija);

        }

        public function izmeniKompaniju(){

             
            $sesija = $this->getSession()->get('korisnik_id');
            $this->set('sesija', $sesija);

            $korisnikModel = new KorisnikModel($this->getDbConnection());
            $korisnik = $korisnikModel->getById($sesija);
            $this->set('korisnik', $korisnik);

            $str = $_GET["URL"];
            $matches = [];
            preg_match('!\d+!', $str, $matches);
            
            $id = $matches[0];

            $kompanijaModel = new KompanijaModel($this->getDbConnection());
            $kompanija = $kompanijaModel->getById($id);
            $this->set('kompanija', $kompanija);


        }

        public function postIzmeniKompaniju(){

            $id = filter_input(INPUT_POST, 'id', FILTER_SANITIZE_NUMBER_INT);
            $grad = filter_input(INPUT_POST, 'grad', FILTER_SANITIZE_STRING);
            $posta = filter_input(INPUT_POST, 'posta', FILTER_SANITIZE_NUMBER_INT);
            $zemlja = filter_input(INPUT_POST, 'zemlja', FILTER_SANITIZE_STRING);
            $ziro = filter_input(INPUT_POST, 'ziro', FILTER_SANITIZE_STRING);
            $telefon = filter_input(INPUT_POST, 'telefon', FILTER_SANITIZE_STRING);
            $link = filter_input(INPUT_POST, 'link', FILTER_SANITIZE_STRING);
            $kontakt = filter_input(INPUT_POST, 'kontakt', FILTER_SANITIZE_STRING);
            $stariLogo = filter_input(INPUT_POST, 'stariLogo', FILTER_SANITIZE_STRING);
            $path = '/Projekat/Assets/img/companyLogos/';
            $fileName = rand(1, 350000) . $_FILES['logo']['name'];
            

            

            if($_FILES['logo']['name'] == ''){
                $logoPath = $stariLogo;
            } else {
                $logoPath = $path . $fileName;
            }
        

            $kompanijaModel = new KompanijaModel($this->getDbConnection());
            $izmeni = $kompanijaModel->editById($id, [

            
                    
                'grad'              => $grad,
                'postanski_broj'    => $posta,
                'zemlja'            => $zemlja,
                'ziro_racun'        => $ziro,
                'kontakt_telefon'   => $telefon,
                'link_kompanije'    => $link,
                'kontakt_osoba'     => $kontakt,
                'logo'              => $logoPath,


            ]);

            if($izmeni){

                if($_FILES['logo']['name'] != ''){
                    move_uploaded_file($_FILES['logo']['tmp_name'], '/var/www/html/Projekat/Assets/img/companyLogos/' . $fileName);

                }
                $this->redirect(\Configuration::BASE . 'pretraga-kompanija/' . $id);


            } else {

                echo "ERROR";
            }
        }


    }