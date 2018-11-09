<?php
    namespace Projekat\Controllers;

    use Projekat\Core\Controller;
    use Projekat\Models\KorisnikModel;

    class AuthController extends Controller {

        public function getLogin(){
            $korisnikModel = new KorisnikModel($this->getDbConnection());
            $dodajKorisnika = $korisnikModel->getAll();
            $this->set('korisnik', $dodajKorisnika);


        }

        public function postLogin(){

            $korisnicko_ime = filter_input(INPUT_POST, 'korisnicko_ime', FILTER_SANITIZE_STRING);
            $lozinka = filter_input(INPUT_POST, 'lozinka', FILTER_SANITIZE_STRING);    

            $korisnikModel = new KorisnikModel($this->getDbConnection());
            $dodajKorisnika = $korisnikModel->getByFieldValue('korisnicko_ime', $korisnicko_ime);

            $passwordHash =  $dodajKorisnika->lozinka;
                                  
            if($korisnicko_ime != $dodajKorisnika->korisnicko_ime){
                $this->set('message', 'Neispravno Korisnicko ime.');
            } elseif(!password_verify($lozinka, $dodajKorisnika->lozinka)){

                $this->set('message', 'Neispravna Lozinka.');
                
            } else {

                $this->getSession()->put('korisnik_id', $dodajKorisnika->korisnik_id);
			    $this->getSession()->save();
			    $this->redirect(\Configuration::BASE . 'ugovori');
                }     
            }

        public function getRegister(){

           
        }

        public function postRegister(){

            $korisnicko_ime = filter_input(INPUT_POST, 'korisnicko_ime', FILTER_SANITIZE_STRING);
            $lozinka        = filter_input(INPUT_POST, 'lozinka', FILTER_SANITIZE_STRING);
            $ime            = filter_input(INPUT_POST, 'imee', FILTER_SANITIZE_STRING);
            $prezime        = filter_input(INPUT_POST, 'prezime', FILTER_SANITIZE_STRING);
            $datum_rodjenja = filter_input(INPUT_POST, 'datum');
            $mobilni        = filter_input(INPUT_POST, 'mobilni', FILTER_SANITIZE_NUMBER_INT);
            $email          = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_STRING);
            $passwordHash   = password_hash($lozinka, PASSWORD_DEFAULT);
         
            $korisnikModel = new KorisnikModel($this->getDbConnection());
            $dodajKorisnika = $korisnikModel->add([

                'korisnicko_ime'        =>  $korisnicko_ime,
                'lozinka'               =>  $passwordHash,
                'ime'                   =>  $ime,
                'prezime'               =>  $prezime,
                'datum_rodjenja'        =>  $datum_rodjenja,
                'mobilni'               =>  $mobilni,
                'email'                 =>  $email

            ]);

            if($dodajKorisnika){

                $this->redirect(\Configuration::BASE . 'auth/login');

            } else {

                $this->redirect(\Configuration::BASE . 'error_page');

            }            
        }

        public function logout(){
            $this->getSession()->remove('korisnik_id');
            $this->getSession()->save();
            $this->redirect(\Configuration::BASE . 'auth\login');
        }

        public function getChangePassword(){
            $sesija = $this->getSession()->get('korisnik_id');
            $this->set('sesija', $sesija);

            $korisnikModel = new KorisnikModel($this->getDbConnection());
            $korisnik = $korisnikModel->getById($sesija);
            $this->set('korisnik', $korisnik);     
   

        }

        public function postChangePassword(){

            $sesija = $this->getSession()->get('korisnik_id');
            $this->set('sesija', $sesija);

           
            $stara_lozinka = filter_input(INPUT_POST, 'lozinka', FILTER_SANITIZE_STRING);
            $nova_lozinka1 = filter_input(INPUT_POST, 'nova_lozinka1', FILTER_SANITIZE_STRING);
            $nova_lozinka2 = filter_input(INPUT_POST, 'nova_lozinka2', FILTER_SANITIZE_STRING);
            $passwordHash = password_hash($nova_lozinka1, PASSWORD_DEFAULT);

            
            $korisnikModel = new KorisnikModel($this->getDbConnection());
            $korisnik = $korisnikModel->getById($sesija);
            $this->set('korisnik', $korisnik);

            $provera_stara = password_verify($stara_lozinka, $korisnik->lozinka);
          

            if($provera_stara != true){

                $this->set('message', 'Stara lozinka nije ispravna.');
                
            }elseif($nova_lozinka1 == $stara_lozinka){
                $this->set('message', 'Nova lozinka ne sme biti ista kao stara lozinka.');
               
            }elseif($nova_lozinka1 != $nova_lozinka2){
                $this->set('message', 'Niste ispravno ponovili novu lozinku.');
                                  
            }elseif(!$korisnik){
                $this->set('message', 'Greska.');
                
            } else {

                $dodajNovuSifru = $korisnikModel->editById($sesija, [

                    'lozinka'   => $passwordHash
    
                    ]);

                $this->redirect(\Configuration::BASE);
                   
             }
          }        
       }
    