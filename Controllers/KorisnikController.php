<?php
    namespace Projekat\Controllers;

    use Projekat\Core\Controller;
    use Projekat\Models\KorisnikModel;

    class KorisnikController extends Controller {

        public function getDodaj() {



            $sesija = $this->getSession()->get('korisnik_id');

            $korisnikModel = new KorisnikModel($this->getDbConnection());
            $korisnik = $korisnikModel->getById($sesija);
            $this->set('korisnik', $korisnik);     

            if($korisnik->role != 'Administrator'){
                $this->redirect(\Configuration::BASE);
            }

          

        }

        public function postDodaj() {

         $kor = filter_input(INPUT_POST, 'kor', FILTER_SANITIZE_STRING);
         $lozinka = filter_input(INPUT_POST, 'lozinka', FILTER_SANITIZE_STRING);
         $ime = filter_input(INPUT_POST, 'imee', FILTER_SANITIZE_STRING);
         $prezime = filter_input(INPUT_POST, 'prezime', FILTER_SANITIZE_STRING);
         $datum = filter_input(INPUT_POST, 'datum', FILTER_SANITIZE_STRING);
         $mobilni = filter_input(INPUT_POST, 'mob', FILTER_SANITIZE_STRING);
         $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_STRING);
         $uloga = filter_input(INPUT_POST, 'uloga', FILTER_SANITIZE_STRING);
         $prihvacen = 1;   
         
         $korisnikModel = new KorisnikModel($this->getDbConnection());
         $dodajKorisnika = $korisnikModel->add([

           
                'korisnicko_ime'    => $kor,
                'lozinka'           => $lozinka,
                'ime'               => $ime,
                'prezime'           => $prezime,
                'datum_rodjenja'    => $datum,
                'mobilni'           => $mobilni,
                'email'             => $email,
                'role'              => $uloga,
                'prihvacen'         => $prihvacen,

         ]);

         if($dodajKorisnika){

            $this->redirect(\Configuration::BASE);
         }
          
        }
    }